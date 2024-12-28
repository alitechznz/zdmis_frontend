<?php

namespace App\Livewire\Proposal;

use App\Models\ProjectProposalOutcome;
use Livewire\Component;

class ProjectOutcomeListComponent extends Component
{
    public $project_proposal_outcomes = [], $project_outcome_name, $concept_note_id, $type = null;
    public function mount($concept_note_id, $type){
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;
        $this->project_proposal_outcomes = ProjectProposalOutcome::where('concept_note_id', $this->concept_note_id)->get();
    }
    public function saveProjectProposalOutcome()
    {
        $this->validate([
            'project_outcome_name' => 'required',
        ]);
        ProjectProposalOutcome::create([
            'concept_note_id' => $this->concept_note_id,
            'name' => $this->project_outcome_name,
        ]);
        $this->project_outcome_name = null;
        $this->dispatch('isFinished', 'step 6');
        $this->dispatch('swal:info', title: 'Saved Successfully!');
        $this->project_proposal_outcomes = ProjectProposalOutcome::where('concept_note_id', $this->concept_note_id)->get();
    }
    public function deleteProjectProposalOutcome(ProjectProposalOutcome $projectProposalOutcome){
        $projectProposalOutcome->delete();
        $this->project_proposal_outcomes = ProjectProposalOutcome::where('concept_note_id', $this->concept_note_id)->get();
        $this->dispatch('swal:info', title: 'Deleted Successfully!');
    }
    public function render()
    {
        return view('livewire.proposal.project-outcome-list-component');
    }
}
