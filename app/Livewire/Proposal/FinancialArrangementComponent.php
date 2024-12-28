<?php

namespace App\Livewire\Proposal;

use App\Models\ConceptNote;
use App\Models\ConceptNoteFinanceArrangement;
use Livewire\Component;

class FinancialArrangementComponent extends Component
{
    public $is_step5 = true;
    public $type, $financingModality, $totalProjectCost, $tentativeFinancingArrangement, $concept_note_id = null, $gfsCode = "";

    protected $listeners = ['conceptNoteSaved' => 'updateConceptNoteId'];

    public function updateConceptNoteId($id)
    {
        $this->concept_note_id = $id;
    }

    public function mount($concept_note_id, $type){
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;
        $cn_finacial = ConceptNoteFinanceArrangement::where('concept_note_id', $this->concept_note_id)->latest()->first();
        if($cn_finacial){
            $this->financingModality = $cn_finacial->financing_modality;
            // $this->gfsCode = $cn_finacial->gfs_code;
            $this->totalProjectCost = $cn_finacial->total_project_cost;
            $this->tentativeFinancingArrangement = $cn_finacial->tentative_financing_arrangement;
        }
    }

    public function updateTentativeFinancingArrangement($value)
    {
        $this->tentativeFinancingArrangement = $value;
    }

    public function SaveProjectFinance()
    {
        $this->validate([
            'financingModality' => 'required',
            // 'gfsCode' => 'nullable',
            'totalProjectCost' => 'required',
            'tentativeFinancingArrangement' => 'required',
        ]);

        // Clean and format totalProjectCost if necessary
        // Remove commas and other formatting from the totalProjectCost before converting it to float
        $cleanTotalProjectCost = str_replace(',', '', $this->totalProjectCost);
        $this->totalProjectCost = number_format((float)$cleanTotalProjectCost, 2, '.', '');


        ConceptNoteFinanceArrangement::updateOrCreate(['concept_note_id' => $this->concept_note_id],[
            'financing_modality' => $this->financingModality,
            'gfs_code' => '',
            'total_project_cost' => $this->totalProjectCost,
            'tentative_financing_arrangement' => $this->tentativeFinancingArrangement,
            'concept_note_id' => $this->concept_note_id
        ]);
        $this->is_step5 = true;
        $this->dispatch('isFinished', 'step 5');
        $this->dispatch('swal:info', title: 'Saved successfully');
    }

    public function ConceptFinish()
    {
        $concept_note = ConceptNote::find($this->concept_note_id);
        if ($concept_note) {
            if ($concept_note?->projectLocations->count() < 0) {
                $this->dispatch('swal:error', title: 'Location Not Entered');
            } elseif(!$concept_note?->explaination()->whereNotNull('justification')->exists()){
                $this->dispatch('swal:error', title: 'Project Details Not Entered');
            } elseif(!$concept_note?->explaination()->whereNotNull('outputs')->exists()){
                $this->dispatch('swal:error', title: 'Project Outcome Not Entered');
            } elseif(!$concept_note?->finacialAggrement){
                $this->dispatch('swal:error', title: 'Financial Not Entered');
            } elseif ($concept_note?->projectPrograms->count() > 0 and $concept_note->class == "Program") {
                $this->dispatch('swal:error', title: 'Program Project Not Entered');
            } else {
                $concept_note->process_status = 10;
                $concept_note->save();
                $this->dispatch('swal:info', title: 'Process Finished');

                return redirect()->route('concept-note-list');
            }
        } else {
            $this->dispatch('swal:error', title: 'Process Not Finished');

        }
    }

    public function render()
    {
        return view('livewire.proposal.financial-arrangement-component');
    }
}
