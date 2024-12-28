<?php

namespace App\Livewire\Proposal;

use App\Models\ConceptNote;
use App\Models\KPI;
use App\Models\PriorityArea;
use App\Models\ProjectProposalIndicator;
use App\Models\ProjectProposalOutput;
use App\Models\UnitValue;
use Livewire\Component;

class ProjectIndicatorComponent extends Component
{
    public $project_proposal_indicators = [], $project_proposal_m_priority_areas = [], $project_proposal_m_indicators = [], $project_proposal_outputs = [], $units = [];
    public $project_proposal_output, $project_proposal_m_indicator, $project_proposal_indicator_created_by;
    public $project_proposal_indicator_name, $project_proposal_indicator_kpi_definition, $project_proposal_indicator_baseline_value, $project_proposal_indicator_baseline_unit;
    public $project_proposal_indicator_target_value, $project_proposal_indicator_target_unit, $project_proposal_indicator_means_verification, $project_proposal_indicator_assumption_risk;
    public $concept_note_id, $type = null, $project_proposal_indicator_priority_area = 0;
    protected $listeners = ['outputSaved' => 'updateOutput'];

    public function mount($concept_note_id, $type){
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;

        $this->project_proposal_m_priority_areas = PriorityArea::where('category', 'middle term')->get();
        $this->units = UnitValue::all();
        $this->project_proposal_indicators = ProjectProposalIndicator::where('concept_note_id', $concept_note_id)->get();
    }

    public function updateOutput($outputs){
        $this->project_proposal_outputs = $outputs;
    }

    public function updatedProjectProposalIndicatorPriorityArea($id){
        $this->project_proposal_m_indicators = KPI::where('priority_area_id', $id)->get();
    }
    public function saveProjectProposalIndicator()
    {
        $this->validate([
            'project_proposal_output' => 'required',
            'project_proposal_indicator_priority_area' => 'required',
            'project_proposal_m_indicator' => 'required',
            'project_proposal_indicator_name' => 'required|string',
            'project_proposal_indicator_kpi_definition' => 'required|string',
            'project_proposal_indicator_baseline_value' => 'required|string',
            'project_proposal_indicator_baseline_unit' => 'required|string',
            'project_proposal_indicator_target_value' => 'required|string',
            'project_proposal_indicator_target_unit' => 'required|string',
        ]);

        ProjectProposalIndicator::create([
            'concept_note_id' => $this->concept_note_id,
            'project_proposal_output_id' => $this->project_proposal_output,
            'priority_area_id' => $this->project_proposal_indicator_priority_area,
            'indicator_id' => $this->project_proposal_m_indicator,
            'indicator_name' => $this->project_proposal_indicator_name,
            'kpi_definition' => $this->project_proposal_indicator_kpi_definition,
            'baseline_value' => $this->project_proposal_indicator_baseline_value,
            'baseline_unit' => $this->project_proposal_indicator_baseline_unit,
            'target_value' => $this->project_proposal_indicator_target_value,
            'target_unit' => $this->project_proposal_indicator_target_unit,
//            'means_verification' => $this->project_proposal_indicator_means_verification,
//            'assumption_risk' => $this->project_proposal_indicator_assumption_risk
        ]);

        $this->dispatch('isFinished', 'step 9');
        $this->dispatch('swal:info', title: 'Indicator Added Successfully!');
        $this->resetProjectProposalInputFields();
        $this->project_proposal_indicators = ProjectProposalIndicator::where('concept_note_id', $this->concept_note_id)->get();
    }
    private function resetProjectProposalInputFields()
    {
        $this->project_proposal_output = $this->project_proposal_indicator_priority_area = $this->project_proposal_m_indicator = '';
        $this->project_proposal_indicator_created_by = $this->project_proposal_indicator_name = $this->project_proposal_indicator_kpi_definition = '';
        $this->project_proposal_indicator_baseline_value = $this->project_proposal_indicator_baseline_unit = $this->project_proposal_indicator_target_value = '';
        $this->project_proposal_indicator_target_unit = $this->project_proposal_indicator_means_verification = $this->project_proposal_indicator_assumption_risk = '';
    }

    public function deleteProjectProposalIndicator(ProjectProposalIndicator $projectProposalIndicator){
        $projectProposalIndicator->delete();
        $this->dispatch('swal:info', title: 'Activity Deleted Successfully!');
        $this->project_proposal_indicators = ProjectProposalIndicator::where('concept_note_id', $this->concept_note_id)->get();

    }

    public function proposalFinish()
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
            } elseif($concept_note?->projectPrograms->count() > 0 and $concept_note->class == "Program") {
                $this->dispatch('swal:error', title: 'Program Project Not Entered');
            }elseif($concept_note?->projectProposalOutcomes->count() < 0){
                $this->dispatch('swal:error', title: 'Proposal Outcome Not Entered');
            } elseif($concept_note?->projectProposalOutputs->count() < 0){
                $this->dispatch('swal:error', title: 'Proposal Output Not Entered');
            } elseif($concept_note?->projectProposalActivities->count() < 0){
                $this->dispatch('swal:error', title: 'Proposal Activity Not Entered');
            } elseif ($concept_note?->projectProposalIndicators->count() < 0){
                $this->dispatch('swal:error', title: 'Proposal Indicator Not Entered');
            } else {
                $concept_note->process_status = 10;
                $concept_note->save();
                $this->dispatch('swal:info', title: 'Process Finished');

                return redirect()->route('proposal-list');
            }
        } else {
            $this->dispatch('swal:error', title: 'Process Not Finished');

        }
    }

    public function render()
    {
        return view('livewire.proposal.project-indicator-component');
    }
}
