<?php

namespace App\Livewire\Proposal;

use App\Models\ConceptNoteExplanation;
use Livewire\Component;

class ProjectOutlineComponent extends Component
{
    public $is_step4 = true;
    public $overallApproach, $output, $inputs, $responsibility, $risk, $concept_note_id, $type = null;

    protected $listeners = ['conceptNoteSaved' => 'updateConceptNoteId'];

    public function updateConceptNoteId($id)
    {
        $this->concept_note_id = $id;
    }

    public function mount($concept_note_id, $type) {
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;

        $output = ConceptNoteExplanation::where('conceptNote_id', $this->concept_note_id)->latest()->first();
        if ($output) {
            $this->overallApproach = $output->overall_approach;
            $this->output = $output->outputs;
            $this->inputs = $output->inputs;
            $this->responsibility = $output->timeframeResponsibility;
            $this->risk = $output->sustainabilityRisk;
        }
    }
    public function saveProjectOutline()
    {
        $this->validate([
            'overallApproach' => 'required',
            'output' => 'required',
            'inputs' => 'required',
            'responsibility' => 'required',
            'risk' => 'required',
        ]);
//        $projectOutline = ConceptNoteExplanation::where('conceptNote_id', $this->concept_note_id);

//        if ($projectOutline) {
        ConceptNoteExplanation::updateOrCreate(['conceptNote_id' => $this->concept_note_id],[
                'overall_approach' => $this->overallApproach,
                'outputs' => $this->output,
                'inputs' => $this->inputs,
                'timeframeResponsibility' => $this->responsibility,
                'sustainabilityRisk' => $this->risk,
            ]);
            $this->is_step4 = true;
            $this->dispatch('isFinished', 'step 4');
            $this->dispatch('swal:info', title: 'Saved successfully!');
//        } else {
//            session()->flash('error', 'Project outline not found.');
//        }
        $this->is_step4 = true;
    }

    public function render()
    {
        return view('livewire.proposal.project-outline-component');
    }
}
