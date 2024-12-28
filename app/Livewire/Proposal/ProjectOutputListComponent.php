<?php

namespace App\Livewire\Proposal;

use App\Models\ProjectProposalOutcome;
use App\Models\ProjectProposalOutput;
use Livewire\Component;

class ProjectOutputListComponent extends Component
{
    public $project_proposal_outputs = [], $project_proposal_outcomes = [];
    public $proposal_output_name, $proposal_output_period, $proposal_outcome_name = null;
    public $concept_note_id, $type = null;
    protected $listeners = ['outcomeSaved' => 'updateOutcome'];
    public function mount($concept_note_id, $type){
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;

        $this->project_proposal_outcomes = ProjectProposalOutcome::where('concept_note_id', $this->concept_note_id)->get();
        $this->project_proposal_outputs = ProjectProposalOutput::where('concept_note_id', $this->concept_note_id)->get();
    }

    public function updateOutcome($outcomes){
        $this->project_proposal_outcomes = $outcomes;
    }
    public function saveProjectProposalOutput()
    {
        $this->validate([
            'proposal_output_name' => 'required',
            'proposal_output_period' => 'required',
            'proposal_outcome_name' => 'required',
        ]);
        ProjectProposalOutput::create([
            'concept_note_id' => $this->concept_note_id,
            'project_proposal_outcome_id' => $this->proposal_outcome_name,
            'output' => $this->proposal_output_name,
            'reporting_period' => $this->proposal_output_period,
        ]);

        $this->proposal_output_name = $this->proposal_output_period = $this->proposal_outcome_name = null;
        $this->dispatch('isFinished', 'step 7');
        $this->dispatch('swal:info', title: 'Saved Successfully!');
        $this->project_proposal_outputs = ProjectProposalOutput::where('concept_note_id', $this->concept_note_id)->get();
    }
    public function deleteProjectProposalOutput(ProjectProposalOutput $projectProposalOutput){
        $projectProposalOutput->delete();
        $this->dispatch('swal:info', title: 'Saved Successfully!');
        $this->project_proposal_outputs = ProjectProposalOutput::where('concept_note_id', $this->concept_note_id)->get();
    }
    public function render()
    {
        return view('livewire.proposal.project-output-list-component');
    }
}
