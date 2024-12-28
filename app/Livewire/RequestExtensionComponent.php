<?php

namespace App\Livewire;

use App\Models\ConceptNote;
use App\Models\ProjectProposalActivity;
use App\Models\ProjectProposalOutcome;
use App\Models\ProjectProposalOutput;
use App\Models\FinancialImplementation;
use App\Models\RequestExtension;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RequestExtensionComponent extends Component
{
    use WithPagination;

    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $total_funding_amount, $new_requested_amount, $financing_agreement_dis, $expected_end_date, $concept_note_id, $outcome_proposal_id, $supporting_document, $remark, $outcome, $output_proposal_id, $amount, $output, $conceptNoteId, $conceptNote, $activity_proposal_id, $activity, $extended_type, $extension_type, $finance_id, $finance_doc_id, $concept_note = null;

    public function create()
    {
        $this->resetField();
    }



    public function store()
    {
        $this->validate([
            'concept_note' => 'required',
            'outcome' => 'nullable',
            'output' => 'nullable',
            'activity' => 'nullable',
            'new_requested_amount' => 'nullable',
            'extension_type' => 'required',
            'supporting_document' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);



        if ($this->supporting_document) {

            // Remove commas for the numeric conversion if there are any
            $formattedAmount = str_replace(',', '', $this->new_requested_amount);
            // Optionally, convert to a number to ensure it's stored as numeric in the database
            $formattedAmount = (float) $formattedAmount;
            // Generate a unique file name with the attachment title and a timestamp
            $filename = $this->extension_type . 'extension' . '_' . time() . '.' . $this->supporting_document->getClientOriginalExtension();

            // Store the file in the 'public' disk under 'financing_agreement_docs' directory with the custom filename
            $filePath = $this->supporting_document->storeAs('Request Extension Docs', $filename, 'public');

            RequestExtension::updateOrCreate(['id' => $this->finance_id], [
                'project_id' => $this->concept_note,
                'outcome_proposal_id' => $this->outcome,
                'output_proposal_id' => $this->output,
                'activity_proposal_id' => $this->activity,
                'new_requested_amount' => $formattedAmount,  // Save the formatted amount
                'extension_type' => $this->extension_type,
                'extended_type' => $this->extended_type,
                'expected_end_date' => $this->expected_end_date,
                'remark' => $this->remark,
                'supporting_document' => $filePath,
            ]);
        }

        $this->dispatch('swal:info', title: $this->finance_id ? 'Extension Request Updated.' : 'Extension Request Created');

        $this->resetField();
        $this->update = false;
        // Close modal
        $this->dispatch('closeModal');
    }



    public function downloadAttachment($id)
    {
        $requestExtension = RequestExtension::findOrFail($id);
        if ($requestExtension && Storage::disk('public')->exists($requestExtension->supporting_document)) {
            return response()->download(storage_path('app/public/' . $requestExtension->supporting_document));
        } else {
            session()->flash('error', 'File does not exist.');
            return redirect()->back();
        }
    }


    private function resetField()
    {
        $this->reset('concept_note', 'outcome', 'supporting_document', 'remark', 'expected_end_date', 'extended_type', 'extension_type', 'output', 'activity', 'new_requested_amount', 'update');
        $this->update = false;
    }



    public function edit($finance_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->finance_id = $finance_id;

        $requestExtension = RequestExtension::findOrFail($finance_id);
        $this->concept_note = $requestExtension->concept_note_id;
        $this->outcome = $requestExtension->outcome_proposal_id;
        $this->output = $requestExtension->output_proposal_id;
        $this->activity = $requestExtension->activity_proposal_id;
        $this->new_requested_amount = $requestExtension->new_requested_amount;
        $this->extension_type = $requestExtension->extension_type;
        $this->extended_type = $requestExtension->extended_type;
        $this->expected_end_date = $requestExtension->expected_end_date;
        $this->remark = $requestExtension->remark;
        $this->supporting_document = $requestExtension->supporting_document;
    }

    //For Financing Agreement
    public function deleteConfirm(RequestExtension $requestExtension)
    {
        $this->delete_confirm = $requestExtension;
    }


    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Extension Request  Deleted');
    }


    public function render()
    {
        $requestExtensions = RequestExtension::query()
            ->with(['conceptNote', 'proposalActivity'])
            ->latest();

        if ($this->search_keyword) {
            // Adjust query to search within relationship fields
            $requestExtensions->whereHas('conceptNote', function ($query) {
                $query->where('projectname', 'like', '%' . $this->search_keyword . '%');
            })
                ->orWhereHas('output', function ($query) {
                    $query->where('reporting_period', 'like', '%' . $this->search_keyword . '%');
                });
        }

        $requestExtensions = $requestExtensions->paginate();

        return view('livewire.request-extension-component', [
            'requestExtensions' => $requestExtensions,
            'projects' => ConceptNote::where('type', 'proposal')->where('process_status', 6)->get(),
            'outcomes' => ProjectProposalOutcome::all(),
            'outputs' => ProjectProposalOutput::all(),
            'activities' => ProjectProposalActivity::all(),
        ])->layout('layouts.app');
    }
}