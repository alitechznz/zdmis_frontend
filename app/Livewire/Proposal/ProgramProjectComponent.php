<?php

namespace App\Livewire\Proposal;

use App\Models\ConceptNoteProgramProject;

use App\Models\Pillar;
use App\Models\Plan;
use App\Models\PriorityArea;
use Livewire\Component;

class ProgramProjectComponent extends Component
{
    public $program_projects = [];
    public $project_name, $type, $concept_note_id, $plan_id, $priority_area, $strategic_area =  null;
    public $is_step1, $is_step2 = true;

    protected $listeners = ['conceptNoteSaved' => 'updateConceptNoteId'];

    public function updateConceptNoteId($id)
    {
        $this->concept_note_id = $id;
    }

    public function mount($concept_node_id = null, $type){

        $this->concept_note_id = $concept_node_id;
        $this->type = $type;
            $this->program_projects = ConceptNoteProgramProject::where('concept_note_id', $this->concept_note_id)->whereNotNull('project_name')->get();
    }
    public function saveProgramProject()
    {
        $this->validate([
            'project_name' => 'required',
            'plan_id' => 'required',
            'priority_area' => 'required',
            'strategic_area' => 'required',
        ]);
        ConceptNoteProgramProject::create([
            'concept_note_id' => $this->concept_note_id,
            'project_name' => $this->project_name,
            'plan_id' => $this->plan_id,
            'priority_area_id' => $this->priority_area,
            'strategic_area_id' => $this->strategic_area,
        ]);
        $this->dispatch('isFinished', 'step 21');
        $this->project_name = $this->plan_id = $this->priority_area = $this->strategic_area = null;
        $this->program_projects = ConceptNoteProgramProject::where('concept_note_id', $this->concept_note_id)->whereNotNull('project_name')->get();
        $this->dispatch('swal:info', title: 'Project Saved');
    }

    public function deleteProgramProject(ConceptNoteProgramProject $conceptNoteProgramProject)
    {
        $conceptNoteProgramProject->delete();
        $this->program_projects = ConceptNoteProgramProject::where('concept_note_id', $this->concept_note_id)->whereNotNull('project_name')->get();
        $this->dispatch('swal:info', title: 'Project Deleted');
    }

    public function render()
    {
        return view('livewire.proposal.program-project-component', [
            'middle_term_plans' => Plan::where('plan_period_type', 'Middle term')->get(),
            'middle_term_strategic_area' => Pillar::where('category', 'middle term')->get(),
            'middle_term_priority_area' => PriorityArea::where('category', 'middle term')->get(),
        ]);
    }
}
