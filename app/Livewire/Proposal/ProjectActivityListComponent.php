<?php

namespace App\Livewire\Proposal;

use App\Models\ProjectProposalActivity;
use App\Models\ProjectProposalOutput;
use App\Models\SourceFinancing;
use Livewire\Component;

class ProjectActivityListComponent extends Component
{
    public $project_proposal_activities = [], $source_of_financial = [], $project_proposal_outputs = [];
    public $proposal_activity_name, $proposal_activity_resource, $proposal_activity_start_date, $proposal_activity_end_date, $proposal_activity_planning_amount;
    public $proposal_activity_output, $proposal_activity_source_financing,$proposal_activity_currency, $proposal_activity_funding_modality;
    public $concept_note_id, $type = null;
    protected $listeners = ['outputSaved' => 'updateOutput'];
    public function mount($concept_note_id, $type){
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;

        $this->source_of_financial = SourceFinancing::where('level', 'National')->get();
        $this->project_proposal_outputs = ProjectProposalOutput::where('concept_note_id', $this->concept_note_id)->get();
        $this->project_proposal_activities = ProjectProposalActivity::where('concept_note_id', $concept_note_id)->get();
    }

    public function updateOutput($outputs){
        $this->project_proposal_outputs = $outputs;
    }
    public function saveProjectProposalActivity()
    {
        $this->validate([
            'proposal_activity_name' => 'required|string|max:255',
            'proposal_activity_resource' => 'required|string',
            'proposal_activity_start_date' => 'required|date',
            'proposal_activity_end_date' => 'required|date|after:proposal_activity_start_date',
            'proposal_activity_planning_amount' => 'required|numeric',
            'proposal_activity_currency' => 'required|string',
            'proposal_activity_output' => 'required|exists:project_proposal_outputs,id',
            'proposal_activity_funding_modality' => 'required|exists:source_financings,id',
        ]);

        ProjectProposalActivity::create([
            'concept_note_id' => $this->concept_note_id,
            'activity_name' => $this->proposal_activity_name,
            'activity_reason' => $this->proposal_activity_resource,
            'start_date' => $this->proposal_activity_start_date,
            'end_date' => $this->proposal_activity_end_date,
            'planning_amount' => $this->proposal_activity_planning_amount,
            'currency' => $this->proposal_activity_currency,
            'project_proposal_output_id' => $this->proposal_activity_output,
            'source_financing_id' => $this->proposal_activity_funding_modality,
        ]);

        $this->dispatch('isFinished', 'step 8');
        $this->dispatch('swal:info', title: 'Activity Saved Successfully!');
        $this->resetProposalActivityInputFields();
        $this->project_proposal_activities = ProjectProposalActivity::where('concept_note_id', $this->concept_note_id)->get();
    }

    public function deleteActivity(ProjectProposalActivity $activity)
    {
        $activity->delete();
        $this->dispatch('swal:info', title: 'Activity Deleted Successfully!');
        $this->project_proposal_activities = ProjectProposalActivity::where('concept_note_id', $this->concept_note_id)->get();
    }

    private function resetProposalActivityInputFields()
    {
        $this->proposal_activity_name = $this->proposal_activity_resource = $this->proposal_activity_start_date = $this->proposal_activity_end_date = $this->proposal_activity_planning_amount = null;
        $this->proposal_activity_currency = $this->proposal_activity_funding_modality = $this->proposal_activity_output =  null;
    }
    public function render()
    {
        return view('livewire.proposal.project-activity-list-component');
    }
}
