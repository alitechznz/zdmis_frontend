<?php

namespace App\Livewire\Proposal;

use App\Models\ConceptNote;
use App\Models\ConceptNoteOutcome;
use App\Models\ConceptNoteProgramProject;
use App\Models\MinistryUser;
use App\Models\InstitutionUser;
use App\Models\DepartmentUser;
use App\Models\Pillar;
use App\Models\Plan;
use App\Models\PriorityArea;
use App\Models\Sector;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GeneralDetailComponent extends Component
{
    public $concept_note_id, $type, $is_step1 = true;
    public $project_title,$start_date,$end_date,$main_sector = null;
    public $organization_name,$responsible_user,$project_category,$plan_id,$priority_area = null;
    public $project_outcome,$contribution_sector, $strategic_area,$plans, $user = null;
    public $sectors = [], $selected_ministry_user = [], $middle_term_plans = [], $selected_class = 'Project', $concept_note=[];

    public $plan_ids, $strategic_area_id, $priority_area_id;
    public $strategic_areas = [], $priority_areas = [];

    protected $listeners = [
        'selectedClass' => 'updateSelectedClass',
        'planChanged' => 'planChanged',
        'strategicAreaChanged' => 'strategicAreaChanged'
    ];


    public function updateSelectedClass($selected_class){
        $this->selected_class = $selected_class;
    }


    public function planChanged($planId)
    {
        logger()->info("Plan Changed: ", ['planId' => $planId]);
        $this->plan_id = $planId;
        $this->strategic_areas = Pillar::where('plan_id', $planId)->orderBy('name')->get();

        $this->priority_areas = []; // Reset priority areas
    }

    public function strategicAreaChanged($strategicAreaId)
    {
        $this->strategic_area_id = $strategicAreaId;
        $this->priority_areas = PriorityArea::where('pillar_id', $strategicAreaId)->orderBy('name')->get();
    }

    public function mount($concept_note_id, $type)
    {
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;

        $this->sectors = Sector::all();
        $this->middle_term_plans = Plan::where('plan_period_type', 'Middle term')->get();


        // if(auth()->user()->ministryUser->ministry->name){
            $user_ministry_name = auth()->user()->ministryUser?->ministry?->name;
            $user_ministry_shortname = auth()->user()->ministryUser?->ministry?->short_name;
            $user_ministry_id = auth()->user()->ministryUser?->ministry?->id;
    //        $this->organization_id = $user_org_id;
            $this->organization_name = $user_ministry_name . ' (' . $user_ministry_shortname . ')';

    //     } elseif(auth()->user()->InstitutionUser->institu->name){
    //         $user_ministry_name = auth()->user()->ministryUser?->ministry?->name;
    //         $user_ministry_shortname = auth()->user()->ministryUser?->ministry?->short_name;
    //         $user_ministry_id = auth()->user()->ministryUser?->ministry?->id;
    // //        $this->organization_id = $user_org_id;
    //         $this->organization_name = $user_ministry_name . ' (' . $user_ministry_shortname . ')';

    //     } elseif(auth()->user()->DepartmentUser->name){
    //         $user_ministry_name = auth()->user()->ministryUser?->ministry?->name;
    //         $user_ministry_shortname = auth()->user()->ministryUser?->ministry?->short_name;
    //         $user_ministry_id = auth()->user()->ministryUser?->ministry?->id;
    // //        $this->organization_id = $user_org_id;
    //         $this->organization_name = $user_ministry_name . ' (' . $user_ministry_shortname . ')';

    //     }


        $this->selected_ministry_user = MinistryUser::where('ministry_id', $user_ministry_id)->get();

        $this->concept_note = ConceptNote::where('createdby', Auth::id());
        if ($concept_note_id){
            $this->concept_note->where('id', $concept_note_id);
        } else {
            $this->concept_note->where('process_status', 0);
        }
        $this->concept_note = $this->concept_note->latest()->first();

        if ($this->concept_note) {
            $project = $this->concept_note->projectPrograms()->where('concept_note_id', $this->concept_note_id)->latest()->first();
            $this->concept_note_id = $this->concept_note->id;
            $this->project_title = $this->concept_note->projectname;
            $this->start_date = date("Y-m-d", strtotime($this->concept_note->start_date));;
            $this->end_date = date("Y-m-d", strtotime($this->concept_note->enddate));;
            $this->main_sector = $this->concept_note->sector_id;
            $this->plans = $this->concept_note->selected_plans;
            $this->contribution_sector = $this->concept_note->contribution_sector;
            $this->organization_name = $this->concept_note->organization?->name;
            $this->responsible_user = $this->concept_note->responsible_user;
            $this->shortname = '';
            $this->project_category = $this->concept_note->description;
            $this->project_outcome = $this->concept_note->outcome?->name;
            $this->selected_class = $this->concept_note->class;
            $this->plan_id = $project?->plan_id;
            $this->priority_area = $project?->priority_area_id;
            $this->strategic_area = $project?->strategic_area_id;

        }
    }

    public function SaveGeneralDetail()
    {
        $concept_note = ConceptNote::updateOrCreate(['id' => $this->concept_note_id], [
            'class' => $this->selected_class,
            'projectname' => $this->project_title,
            'startdate' => $this->start_date,
            'enddate' => $this->end_date,
            'sector_id' => $this->main_sector,
            'contribution_sector' => $this->contribution_sector,
            'organization_name' => auth()->user()->ministryUser?->ministry?->id,
            'responsible_user' => $this->responsible_user,
            'process_status' => 0,
            'shortname' => '',
            'type' => $this->type,
            'description' => $this->project_category
        ]);

        if ($this->selected_class == "Project") {
            ConceptNoteProgramProject::create([
                'concept_note_id' => $concept_note->id,
                'plan_id' => $this->plan_id,
                'priority_area_id' => $this->priority_area,
                'strategic_area_id' => $this->strategic_area,
            ]);
        }

        $project_outcome = new ConceptNoteOutcome([
            'name' => $this->project_outcome,
            'conceptnote_id' => $concept_note->id
        ]);
        $project_outcome->save();
        $this->is_step1 = true;
        $this->concept_note_id = $concept_note->id;
        $this->dispatch('conceptNoteSaved', $concept_note->id);
        $this->dispatch('isFinished', 'step 1');
        $this->dispatch('swal:info', title: 'General Detail Saved');
    }
    public function render()
    {
        if($this->strategic_areas){
            $middle_term_strategic_area = $this->strategic_areas;
        } else {
            $middle_term_strategic_area = Pillar::where('category', 'middle term')->orderBy('name')->get();
        }
        if($this->priority_areas){
            $middle_term_priority_area = $this->priority_areas;
        } else {
            $middle_term_priority_area = PriorityArea::where('category', 'middle term')->orderBy('name')->get();
        }

        return view('livewire.proposal.general-detail-component', [
            'middle_term_plans' => Plan::where('plan_period_type', 'Middle term')->get(),
            'middle_term_strategic_area' => $middle_term_strategic_area,
            'middle_term_priority_area' => $middle_term_priority_area,
        ]);
    }
}
