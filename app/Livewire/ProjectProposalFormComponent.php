<?php

namespace App\Livewire;

use App\Models\ConceptNote;
use App\Models\ConceptNoteExplanation;
use App\Models\ConceptNoteFinanceArrangement;
use App\Models\ConceptNoteLocation;
use App\Models\ConceptNoteOutcome;
use App\Models\ConceptNoteProgramProject;
use App\Models\ProjectProposalOutcome;
use App\Models\ProjectProposalOutput;
use App\Models\Sector;
use Livewire\WithPagination;
use Livewire\Component;

class ProjectProposalFormComponent extends Component
{

    use WithPagination;
    public $is_step1 = false, $is_step2 = false, $is_step21 = false, $is_step3 = false, $is_step4 = false, $is_step5 = false;
    public $is_step6 = false, $is_step7 = false, $is_step8 = false, $is_step9 = false, $is_step10 = false, $is_step11 = false;
    public $selectedLocationLevel = "Shehia";
    public $concept_note_id, $proposal_note = null;
    public $selected_class = 'Project';

    protected $listeners = ['conceptNoteSaved' => 'updateConceptNoteId', 'isFinished' => 'updateStep'];

    public function mount($id)
    {
        $concept_note = ConceptNote::where('id', $id)->where('createdby', auth()->user()->id)->latest()->first();
        if ($concept_note) {
            $proposal_note = ConceptNote::where('concept_note_id', $id)->where('createdby', auth()->user()->id)->latest()->first();
            if($proposal_note){
                $this->concept_note_id = $proposal_note->id;
                $this->proposal_note = $proposal_note;
            } else {
                $proposal_note = ConceptNote::create([
                    'class' => $concept_note->class,
                    'projectname' => $concept_note->projectname,
                    'startdate' => $concept_note->startdate,
                    'enddate' => $concept_note->enddate,
                    'sector_id' => $concept_note->sector_id,
                    'contribution_sector' => $concept_note->contribution_sector,
                    'organization_name' => $concept_note->organization_name,
                    'responsible_user' => $concept_note->responsible_user,
                    'process_status' => 0,
                    'shortname' => '',
                    'type' => "Proposal Note",
                    'description' => $concept_note->description,
                    'concept_note_id' => $id,
                ]);

                $this->concept_note_id = $proposal_note->id;
                $this->proposal_note = $proposal_note;

                $cn_program_projects = ConceptNoteProgramProject::where('concept_note_id', $id)->get();
                foreach ($cn_program_projects as $cn_program_project) {
                    ConceptNoteProgramProject::create([
                        'concept_note_id' => $this->concept_note_id,
                        'project_name' => $cn_program_project->project_name,
                        'plan_id' => $cn_program_project->plan_id,
                        'priority_area_id' => $cn_program_project->priority_area_id,
                        'strategic_area_id' => $cn_program_project->strategic_area_id,
                        'Type' => 'Proposal Note',
                    ]);
                }

                $project_outcomes = ConceptNoteOutcome::where('conceptnote_id', $id)->get();
                foreach ($project_outcomes as $project_outcome) {
                    ConceptNoteOutcome::create([
                        'name' => $project_outcome->name,
                        'conceptnote_id' => $this->concept_note_id
                    ]);
                }

                $cn_locations = ConceptNoteLocation::where('concept_note_id', $id)->get();
                foreach ($cn_locations as $cn_location) {
                    ConceptNoteLocation::create([
                        'location_name' => $cn_location->location_name,
                        'location_id' => $cn_location->location_id,
                        'location_level' => $cn_location->location_level,
                        'concept_note_id' => $this->concept_note_id,
                        'type' => 'Proposal Note'
                    ]);
                }

                $cn_explainations = ConceptNoteExplanation::where('conceptNote_id', $id)->get();
                foreach ($cn_explainations as $cn_explaination) {
                    ConceptNoteExplanation::create([
                        'background' => $cn_explaination->background,
                        'justification' => $cn_explaination->justification,
                        'outcome' => $cn_explaination->outcome,
                        'objective' => $cn_explaination->objective,
                        'conceptNote_id' => $this->concept_note_id,
                        'overall_approach' => $cn_explaination->overall_approach,
                        'outputs' => $cn_explaination->outputs,
                        'inputs' => $cn_explaination->inputs,
                        'timeframeResponsibility' => $cn_explaination->timeframeResponsibility,
                        'sustainabilityRisk' => $cn_explaination->sustainabilityRisk,
                        'type' => 'Proposal Note'
                    ]);
                }

                $cn_financials = ConceptNoteFinanceArrangement::where('concept_note_id', $id)->get();
                foreach ($cn_financials as $cn_financial) {
                    ConceptNoteFinanceArrangement::create([
                        'financing_modality' => $cn_financial->financing_modality,
                        'gfs_code' => $cn_financial->gfs_code,
                        'total_project_cost' => $cn_financial->total_project_cost,
                        'tentative_financing_arrangement' => $cn_financial->tentative_financing_arrangement,
                        'concept_note_id' => $this->concept_note_id,
//                        'type' => 'Proposal Note'
                    ]);
                }
            }

            $this->selected_class = $proposal_note->class;

            if ($proposal_note?->outcome) {
                $this->is_step1 = true;
            }
            if ($proposal_note?->projectLocations->count() > 0) {
                $this->is_step2 = true;
            }
            if($proposal_note?->explaination()->whereNotNull('justification')->exists()){
                $this->is_step3 = true;
            }
            if($proposal_note?->explaination()->whereNotNull('outputs')->exists()){
                $this->is_step4 = true;
            }
            if($proposal_note?->finacialAggrement){
                $this->is_step5 = true;
            }
            if($proposal_note?->projectProposalOutcomes->count() > 0){
                $this->is_step6 = true;
            }
            if($proposal_note?->projectProposalOutputs->count() > 0){
                $this->is_step7 = true;
            }
            if($proposal_note?->projectProposalActivities->count() > 0){
                $this->is_step8 = true;
            }
            if($proposal_note?->projectProposalIndicators->count() > 0){
                $this->is_step9 = true;
            }
        } else {
            abort(404);
        }
    }

    public function updateConceptNoteId($id): void
    {
        $this->concept_note_id = $id;
    }

    public function updateStep($step): void
    {
        if ($step == 'step 1') {
            $this->is_step1 = true;
        }
        if ($step == 'step 2') {
            $this->is_step2 = true;
        }
        if ($step == 'step 3') {
            $this->is_step3 = true;
        }
        if ($step == 'step 4') {
            $this->is_step4 = true;
        }
        if ($step == 'step 5') {
            $this->is_step5 = true;
        }
        if ($step == 'step 6') {
            $this->is_step6 = true;
        }
        if ($step == 'step 7') {
            $this->is_step7 = true;
        }
        if ($step == 'step 8') {
            $this->is_step8 = true;
        }
        if ($step == 'step 9') {
            $this->is_step9 = true;
        }
        if ($step == 'step 10') {
            $this->is_step10 = true;
        }
        if ($step == 'step 21') {
            $this->is_step21 = true;
        }
    }

    public function updatedSelectedClass(): void
    {
        $this->dispatch('selectedClass', $this->selected_class);
    }

    public $active_tab = "general_details";
    public $sectors = [];
    public function switchTab($active_tab): void
    {
        $this->active_tab = $active_tab;
        if($active_tab == "general_details"){
            $this->sectors = Sector::all();
        } elseif ( $active_tab == "project_proposal_output"){
            $outcomes = ProjectProposalOutcome::where('concept_note_id', $this->concept_note_id)->get();
            $this->dispatch('outcomeSaved', $outcomes);
        } elseif ($active_tab == "activity_list" or $active_tab == "indicator_list"){
            $outputs = ProjectProposalOutput::where('concept_note_id', $this->concept_note_id)->get();
            $this->dispatch('outputSaved', $outputs);
        }
    }

    public function render()
    {
        return view('livewire.project-proposal-form-component')->layout('layouts.app');
    }
}
