<?php

namespace App\Livewire\Proposal;

use App\Models\ConceptNoteExplanation;
use Livewire\Component;

class ProjectDetailComponent extends Component
{
    public $is_step3 = true;
    public $background, $justification, $outcomes, $objective, $concept_note_id, $type = null;

    protected $listeners = ['conceptNoteSaved' => 'updateConceptNoteId'];

    public function updateConceptNoteId($id)
    {
        $this->concept_note_id = $id;
    }

    public function mount($concept_note_id = null, $type) {
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;
        $explanation = ConceptNoteExplanation::where('conceptNote_id', $this->concept_note_id)->latest()->first();
        if ($explanation) {
            $this->background = $explanation->background;
            $this->justification = $explanation->justification;
            $this->outcomes = $explanation->outcome;
            $this->objective = $explanation->objective;
        }
    }
    public function SaveProjectDetails()
    {
        $this->validate([
            'background' => 'required',
            'justification' => 'required',
            'outcomes' => 'required',
            'objective' => 'required',
        ]);
        ConceptNoteExplanation::updateOrCreate(['conceptNote_id' => $this->concept_note_id],[
            'background' => $this->background,
            'justification' => $this->justification,
            'outcome' => $this->outcomes,
            'objective' => $this->objective,
            'conceptNote_id' => $this->concept_note_id
        ]);

        $this->is_step3 = true;
        $this->dispatch('isFinished', 'step 3');
        $this->dispatch('swal:info', title: 'Saved successfully');
    }
    public function render()
    {
        return view('livewire.proposal.project-detail-component');
    }
}
