<?php

namespace App\Livewire;

use App\Models\ConceptNote;
use App\Models\FinancialImplementation;
use App\Models\ProjectProposalActivity;
use App\Models\ProjectProposalOutcome;
use App\Models\ProjectProposalOutput;
use Livewire\Component;
use Livewire\WithPagination;

class FinancialDisbursingComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $total_funding_amount, $report_type, $total_disburesement, $remained_amount, $financing_agreement_dis, $concept_note_id, $outcome_proposal_id, $outcome, $output_proposal_id, $amount, $output, $conceptNoteId, $conceptNote, $activity_proposal_id, $activity, $requested_amount, $percent_requested, $finance_id, $finance_doc_id, $concept_note = null;

    public function create()
    {
        $this->resetField();
    }



    public function store()
    {
        $this->validate([
            'concept_note' => 'required',
            'outcome' => 'required',
            'output' => 'required',
            'activity' => 'required',
            'requested_amount' => 'required|string',
        ]);

        // Remove commas for the numeric conversion if there are any
        $formattedAmount = str_replace(',', '', $this->requested_amount);
        // Optionally, convert to a number to ensure it's stored as numeric in the database
        $formattedAmount = (float) $formattedAmount;


        FinancialImplementation::updateOrCreate(['id' => $this->finance_id], [
            'concept_note_id' => $this->concept_note,
            'outcome_proposal_id' => $this->outcome,
            'output_proposal_id' => $this->output,
            'activity_proposal_id' => $this->activity,
            'requested_amount' => $formattedAmount,  // Save the formatted amount
            'report_type' => $this->report_type,  // Save the formatted amount
            'total_disburesement' => 3000,  // Save the formatted amount
            'remained_amount' => 2000,  // Save the formatted amount
            'percent_requested' => $this->percent_requested,
        ]);

        $this->dispatch('swal:info', title: $this->finance_id ? 'Financial Implementation Updated.' : 'Financial Implementation Created');

        $this->resetField();
        $this->update = false;
        // Close modal
        $this->dispatch('closeModal');
    }

    private function resetField()
    {
        $this->reset('concept_note', 'outcome', 'report_type', 'total_disburesement', 'remained_amount',  'output', 'activity', 'requested_amount', 'percent_requested', 'update');
        $this->update = false;
    }



    public function edit($finance_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->finance_id = $finance_id;

        $financingAgreement = FinancialImplementation::findOrFail($finance_id);
        $this->concept_note = $financingAgreement->concept_note_id;
        $this->outcome = $financingAgreement->outcome_proposal_id;
        $this->output = $financingAgreement->output_proposal_id;
        $this->activity = $financingAgreement->activity_proposal_id;
        $this->requested_amount = $financingAgreement->requested_amount;
        $this->percent_requested = $financingAgreement->percent_requested;
    }

    //For Financing Agreement
    public function deleteConfirm(FinancialImplementation $financialImplementation)
    {
        $this->delete_confirm = $financialImplementation;
    }


    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Financial Implementation  Deleted');
    }


    public function render()
    {
        $financialImplementations = FinancialImplementation::query()
            ->with(['conceptNote', 'proposalActivity'])
            ->latest();

        if ($this->search_keyword) {
            // Adjust query to search within relationship fields
            $financialImplementations->whereHas('conceptNote', function ($query) {
                $query->where('projectname', 'like', '%' . $this->search_keyword . '%');
            })
                ->orWhereHas('output', function ($query) {
                    $query->where('reporting_period', 'like', '%' . $this->search_keyword . '%');
                });
        }

        $financialImplementations = $financialImplementations->paginate();

        return view('livewire.financial-disbursing-component', [
            'financialImplementations' => $financialImplementations,
            'projects' => ConceptNote::where('type', 'proposal')->where('process_status', 6)->get(),
            'outcomes' => ProjectProposalOutcome::all(),
            'outputs' => ProjectProposalOutput::all(),
            'activities' => ProjectProposalActivity::all(),
        ])->layout('layouts.app');
    }
}
