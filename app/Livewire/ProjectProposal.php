<?php

namespace App\Livewire;
use App\Models\ConceptNote;
use App\Models\DecisionFlow;
use App\Models\Plan;
use App\Models\District;
use App\Models\Region;
use App\Models\Shehia;
use App\Models\Sector;
use App\Models\MinistryUser;
use App\Models\ConceptNoteOutcome;
use App\Models\ConceptNoteLocation;
use App\Models\ConceptNoteExplanation;
use App\Models\ConceptNoteFinanceArrangement;

use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\Component;

class ProjectProposal extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $title, $section, $number, $result, $section_number, $projectquestion_id = null;

    public $conceptNoteId;
    public $initiateComment;
    public $concept_name;

    public $conceptID;
    public $FeedbackStatus="";
    public $action;
    public $remark;

    public $organization_id;
    public $organization_name;
    public $project_title;
    public $start_date;
    public $end_date;
    public $main_sector;
    public $project_outcome;
    public $plan;
    public $contribution_sector;
    public $userId;

    public $is_step1=false;
    public $is_step2=false;
    public $is_step3=false;
    public $is_step4=false;
    public $is_step5=false;
    public $is_step6=false;
    public $is_step7=false;
    public $is_step8=false;
    public $is_step9=false;
    public $is_step10=false;
    public $is_step11=false;
    public $is_step12=false;

    public $responsible_user;
    public $name, $cn_project_id;
    public $concept_note_id;
    public $region_field, $district_field, $shehia_field, $selectedShehia, $selectedDistrict;
    public $selectedRegion;
    public $selectedLocationLevel;
    public $project;
    public $cn_project_location_list=[];
    public $project_category;

    public $background;
    public $justification;
    public $outcomes;

    public $overallApproach;
    public $outputs;
    public $inputs;
    public $timeframeResponsibility;
    public $sustainabilityRisk;
    public $conceptnote;

    public $financingModality;
    public $gfsCode;
    public $totalProjectCost;
    public $tentativeFinancingArrangement;
    public $terms;

    public function mount()
    {
        $this->cn_project_id = $this->concept_note_id;
    }

    public function edit($concept_id){
        return view('livewire.concept-note-form-component')->layout('layouts.app');
    }

    public function view($concept_id){
        return view('livewire.concept-note-form-component')->layout('layouts.app');
    }

    public function deleteConfirm(ConceptNote $concept_id)
    {
        $this->delete_confirm = $concept_id;
    }

    public function SaveGeneralDetail()
    {
        // If you need to convert it to a string
        $now = Carbon::now();
        $nowString = $now->toDateTimeString(); // 2023-10-06 12:15:30

        $project = new ConceptNote([
            'projectname' => $this->project_title,
            'startdate' => $this->start_date,
            'enddate' => $this->end_date,
            'sector_id' => $this->main_sector,
            'selected_plans' => $this->plan,
            'contribution_sector' => $this->contribution_sector,
            'organization_name' => $this->organization_id,
            'responsible_user' => $this->responsible_user,
            'process_status' => 0,
            'createdby' => auth()->id(),
            'shortname' => '',
            'description' => $this->project_category
        ]);
        $project->save();


        $project_outcome = new ConceptNoteOutcome([
            'name' => $this->project_outcome,
            'conceptnote_id' => $project->id
        ]);
        $project_outcome->save();
        $this->is_step1 = true;
        $this->concept_note_id = $project->id;
        session()->flash('message', 'Project details saved successfully.');
    }

    public function SaveProjectLocation()
    {

        $location_id =0;
        $location_name="";
        if($this->selectedLocationLevel =="Region"){
            $location_id = $this->region_field;
        } elseif($this->selectedLocationLevel =="District"){
            $location_id = $this->district_field;
        } elseif($this->selectedLocationLevel =="Shehia"){
            $location_id = $this->shehia_field;
        }
        // dd($this->concept_note_id);
        $location = new ConceptNoteLocation([
            'location_name' =>$location_name,
            'location_id' => $location_id,
            'location_level' =>$this->selectedLocationLevel,
            'concept_note_id' =>$this->concept_note_id
        ]);

        $location->save();
        $this->is_step2 = true;

        //fetch location list
        $this->cn_project_location_list =ConceptNoteLocation::where('concept_note_id', $this->concept_note_id)->get();
        session()->flash('message', 'Location saved successfully.');
    }

    public function SaveProjectDetails()
    {
        $projectDetail = new ConceptNoteExplanation([
            'background' => $this->background,
            'justification' => $this->justification,
            'outcomes' => $this->outcomes,
            'conceptNote_id' =>$this->concept_note_id
        ]);

        $projectDetail->save();
        $this->is_step3 = true;
        session()->flash('message', 'Project details saved successfully.');
    }

    public function SaveProjectOutline()
    {
        $projectOutline = ConceptNoteExplanation::find($this->concept_note_id);

        if ($projectOutline) {
            $projectOutline->update([
                'overall_approach' => $this->overallApproach,
                'outputs' => $this->outputs,
                'inputs' => $this->inputs,
                'timeframeResponsibility' => $this->timeframeResponsibility,
                'sustainabilityRisk' => $this->sustainabilityRisk
            ]);
            $this->is_step4 = true;
            session()->flash('message', 'Project outline updated successfully!');
        } else {
            session()->flash('error', 'Project outline not found.');
        }
        $this->is_step4 = true;
    }

    public function SaveProjectFinance()
    {
        $projectDetail = new ConceptNoteFinanceArrangement([
            'financing_modality' => $this->financingModality,
            'gfs_code' => $this->gfsCode,
            'total_project_cost' => $this->totalProjectCost,
            'tentative_financing_arrangement' => $this->tentativeFinancingArrangement,
            'conceptNote_id' => $this->concept_note_id
        ]);
        $this->is_step5 = true;
        session()->flash('message', 'Project finance details saved successfully.');
    }

    public function ConceptFinish()
    {
        $conceptNote = ConceptNote::find($this->concept_note_Id);
        if ($conceptNote) {
            $conceptNote->process_status = 10;
            $conceptNote->save();

            session()->flash('message', 'Concept note process status updated successfully!');
            dd($this->concept_note_Id);
        } else {
            session()->flash('error', 'Concept note not found.');
        }
    }



    public function render()
    {
        $now = Carbon::now(); // This returns a Carbon instance for the current date and time
        if (auth()->check()) {
            $userId = auth()->id();

            $user_org = auth()->user()->ministryUser?->ministry?->name;
            $user_org_short = auth()->user()->ministryUser?->ministry?->short_name;
            $user_org_id = auth()->user()->ministryUser?->ministry?->id;

            $this->organization_id = $user_org_id;
            $this->organization_name = $user_org.' ('.$user_org_short.')';

        }

         // Fetch all items from each mod
         $conceptNotes = ConceptNote::where('process_status', 6)->where('type','Proposal')->get();
         $plans = Plan::all();
         $plans_middle = Plan::where('plan_period_type', 'Middle term')->get();
         $districts = District::where('region_id', $this->region_field)->get();
         $regions = Region::all();
         $shehias = Shehia::where('district_id', $this->district_field)->get();
         $sectors = Sector::all();

         //fetch the other user of the current user
         $selected_ministry_user = MinistryUser::where('ministry_id', $this->organization_id)->get();

         //check if the data steps completed
         $data_steps_1 = ConceptNoteOutcome::where('conceptnote_id', $this->concept_note_id)->count();
         if($data_steps_1 > 0){
             $this->is_step1 = true;
         } else {
             $this->is_step1 = false;
         }

         $data_steps_2 = ConceptNoteLocation::where('concept_note_id', $this->concept_note_id)->count();
         if($data_steps_2 > 0){
             $this->is_step2 = true;
         } else {
             $this->is_step2 = false;
         }


        return view('livewire.project-proposal', [
            'conceptNotes' => $conceptNotes,
            'plans' => $plans,
            'districts' => $districts,
            'regions' => $regions,
            'shehias' => $shehias,
            'sectors' => $sectors,
            'plans_middle' => $plans_middle,
            'selected_ministry_user'=>$selected_ministry_user,
        ])->layout('layouts.app');
    }
}
