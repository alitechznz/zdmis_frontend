<?php

namespace App\Livewire;
use App\Models\ConceptNote;
use App\Models\DecisionFlow;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ConceptNoteComponent extends Component
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

    public $cn_action_v1, $cn_action_v2, $cn_action_v3, $cn_action_v4, $cn_action_v5, $cn_action_v6, $cn_action_v7;
    public $cn_remark_v1, $cn_remark_v2, $cn_remark_v3, $cn_remark_v4, $cn_remark_v5, $cn_remark_v6, $cn_remark_v7;


    public function mount()
    {
        // $id
        // $this->conceptNoteId = $id;
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

    public function verifyConcept()
    {
        $now = Carbon::now();
        $nowString = $now->toDateTimeString(); // 2023-10-06 12:15:30
        $this->FeedbackStatus = 'Verified';

        $project_flow = new DecisionFlow([
            'conceptnote_id' => $this->conceptID,
            'status' => $this->FeedbackStatus,
            'comment' => $this->cn_remark_v1,
            'action' => $this->cn_action_v1,
            'user_id' => auth()->id(),
            'role_id' => auth()->id(),
            'page' => 'Concept',
        ]);
        $project_flow->save();

         // Update the process_status in the concept_note table
         if($this->cn_action_v1 == 'accept') {
            $conceptNote = ConceptNote::find($this->conceptID);
            if ($conceptNote) {
                $conceptNote->process_status = 2;
                $conceptNote->return_status = 0;
                $conceptNote->save();
            }
         } else {
            $conceptNote = ConceptNote::find($this->conceptID);
            if ($conceptNote) {
                $conceptNote->process_status = 2;
                $conceptNote->return_status = 1;
                $conceptNote->save();
            }
         }

        $this->dispatch('swal:info', title: 'Successfully Sent');
           //close modal
        $this->dispatch('closeModal');
    }

    public function submitConcept()
    {
        $now = Carbon::now();
        $nowString = $now->toDateTimeString(); // 2023-10-06 12:15:30
        $this->FeedbackStatus = 'Submitted';

        $project_flow = new DecisionFlow([
            'conceptnote_id' => $this->conceptID,
            'status' => $this->FeedbackStatus,
            'comment' => $this->cn_remark_v2,
            'action' => $this->cn_action_v2,
            'user_id' => auth()->id(),
            'role_id' => auth()->id(),
            'page' => 'Concept',
        ]);
        $project_flow->save();

         // Update the process_status in the concept_note table
         if($this->cn_action_v2 == 'accept') {
            $conceptNote = ConceptNote::find($this->conceptID);
            if ($conceptNote) {
                $conceptNote->process_status = 3;
                $conceptNote->return_status = 0;
                $conceptNote->save();
            }
         } else {
            $conceptNote = ConceptNote::find($this->conceptID);
            if ($conceptNote) {
                $conceptNote->process_status = 3;
                $conceptNote->return_status = 1;
                $conceptNote->save();
            }
         }
        $this->dispatch('swal:info', title: 'Successfully Sent');
           //close modal
        $this->dispatch('closeModal');
    }

    public function ReceiveConcept()
    {
        $now = Carbon::now();
        $nowString = $now->toDateTimeString(); // 2023-10-06 12:15:30
        $this->FeedbackStatus = 'ZPC Received';

        $project_flow = new DecisionFlow([
            'conceptnote_id' => $this->conceptID,
            'status' => $this->FeedbackStatus,
            'comment' => $this->cn_remark_v3,
            'action' => $this->cn_action_v3,
            'user_id' => auth()->id(),
            'role_id' => auth()->id(),
            'page' => 'Concept',
        ]);
        $project_flow->save();

         // Update the process_status in the concept_note table
         if($this->cn_action_v3 == 'accept') {
            $conceptNote = ConceptNote::find($this->conceptID);
            if ($conceptNote) {
                $conceptNote->process_status = 4;
                $conceptNote->return_status = 0;
                $conceptNote->save();
            }
         } else {
            $conceptNote = ConceptNote::find($this->conceptID);
            if ($conceptNote) {
                $conceptNote->process_status = 4;
                $conceptNote->return_status = 1;
                $conceptNote->save();
            }
         }
        $this->dispatch('swal:info', title: 'Successfully Sent');
           //close modal
        $this->dispatch('closeModal');
    }

    public function openConcept()
    {
        $now = Carbon::now();
        $nowString = $now->toDateTimeString(); // 2023-10-06 12:15:30
        $this->FeedbackStatus = 'ZPC Process';

        $project_flow = new DecisionFlow([
            'conceptnote_id' => $this->conceptID,
            'status' => $this->FeedbackStatus,
            'comment' => $this->cn_remark_v4,
            'action' => $this->cn_action_v4,
            'user_id' => auth()->id(),
            'role_id' => auth()->id(),
            'page' => 'Concept',
        ]);
        $project_flow->save();

         // Update the process_status in the concept_note table
         if($this->cn_action_v4 == 'accept') {
            $conceptNote = ConceptNote::find($this->conceptID);
            if ($conceptNote) {
                $conceptNote->process_status = 5;
                $conceptNote->return_status = 0;
                $conceptNote->save();
            }
         } else {
            $conceptNote = ConceptNote::find($this->conceptID);
            if ($conceptNote) {
                $conceptNote->process_status = 5;
                $conceptNote->return_status = 1;
                $conceptNote->save();
            }
         }
        $this->dispatch('swal:info', title: 'Successfully Sent');
           //close modal
        $this->dispatch('closeModal');
    }


    public function ApproveConcept()
    {
        $now = Carbon::now();
        $nowString = $now->toDateTimeString(); // 2023-10-06 12:15:30
        $this->FeedbackStatus = 'Approve';

        $project_flow = new DecisionFlow([
            'conceptnote_id' => $this->conceptID,
            'status' => $this->FeedbackStatus,
            'comment' => $this->cn_remark_v5,
            'action' => $this->cn_action_v5,
            'user_id' => auth()->id(),
            'role_id' => auth()->id(),
            'page' => 'Concept',
        ]);
        $project_flow->save();


        if($this->cn_action_v5 == 'accept') {
            $conceptNotes = ConceptNote::find($this->conceptID);
            if ($conceptNotes) {
                $projectCode = self::generateProjectCode($conceptNotes);
                $conceptNotes->project_code = $projectCode;
                $conceptNotes->process_status = 6;
                $conceptNotes->return_status = 0;
                $conceptNotes->save();
            }
        } else {
            $conceptNotes = ConceptNote::find($this->conceptID);
            if ($conceptNotes) {
                $conceptNotes->return_status = 1;
                $conceptNotes->process_status = 6;
                $conceptNotes->save();
            }
        }

         // Update the process_status in the concept_note table
        //  $conceptNote = ConceptNote::find($this->conceptID);
        //  if ($conceptNote) {
        //      $conceptNote->process_status = 6;
        //      $conceptNote->save();
        //  }



        $this->dispatch('swal:info', title: 'Successfully Sent');
           //close modal
        $this->dispatch('closeModal');
    }


    public static function generateProjectCode(ConceptNote $conceptNote)
    {
        // $organization = $conceptNote->organization;
        $financing = $conceptNote->finacialAggrement;


        $user_ministry_name = auth()->user()->ministryUser?->ministry?->name;
        $user_ministry_shortname = auth()->user()->ministryUser?->ministry?->short_name;
        $user_ministry_id = auth()->user()->ministryUser?->ministry?->id;

        $org_id = $conceptNote->organization_name;

        // Extract vote number
        $voteNumber = auth()->user()->ministryUser?->ministry?->vote_number;
        dd($voteNumber);

        // Determine project type code
        $projectTypeCode = $conceptNote->description === 'A:Strategic' ? 'A' : 'B';

        // Determine financial modality code
        if($financing){
        switch ($financing->financing_modality) {
            case "SMZ Central":
                $financialModalityCode = 'G.1';
                break;
            case "SMZ LGAs":
                $financialModalityCode = 'G.2';
                break;
            case "SMZ & Donor":
                $financialModalityCode = 'G.D';
                break;
            case "Donor Grant":
                $financialModalityCode = 'D.1';
                break;
            case "Donor Loan":
                $financialModalityCode = 'D.2';
                break;
            case "Investment":
                $financialModalityCode = 'P';
                break;
            case "PPP":
                $financialModalityCode = 'I';
                break;
            case "NGO":
                $financialModalityCode = 'N';
                break;
            default:
                $financialModalityCode = 'X'; // Unknown or other
        }
    } else {
        $financialModalityCode ='X';
    }
        // Format time period
        $startYear = Carbon::parse($conceptNote->start_date)->format('Y');
        $endYear = Carbon::parse($conceptNote->end_date)->format('Y');
        $timePeriod = $startYear === $endYear ? $startYear : "{$startYear}-{$endYear}";

        // Count projects for this organization
        $project_code_get ="";
        $projectCount = ConceptNote::where('organization_name', $org_id)->where('process_status', 6)->count() + 1;
        if( $projectCount < 10) {
            $project_code_get = "000".$projectCount;
        } elseif( $projectCount >= 10 && $projectCount < 100) {
            $project_code_get = "00".$projectCount;
        } elseif( $projectCount >= 100 && $projectCount < 999) {
            $project_code_get= "0".$projectCount;
        } else {
            $project_code_get = $projectCount;
        }

        // Assemble project code
        $projectCode = "{$voteNumber}/{$projectTypeCode}{$financialModalityCode}/{$timePeriod}/{$project_code_get}";

        return $projectCode;
    }

    public function Initiate(ConceptNote $concept_id)
    {
        $this->delete_confirm = $concept_id;
        $this->concept_name = $concept_id->projectname;
        $this->conceptID = $concept_id->id;
    }

    public function initiateConcept()
    {
        $now = Carbon::now();
        $nowString = $now->toDateTimeString(); // 2023-10-06 12:15:30
        $this->FeedbackStatus = 'Initiated';

        $project_flow = new DecisionFlow([
            'conceptnote_id' => $this->conceptID,
            'status' => $this->FeedbackStatus,
            'comment' => $this->initiateComment,
            'action' => $this->FeedbackStatus,
            'user_id' => auth()->id(),
            'role_id' => auth()->id(),
            'page' => 'Concept',
        ]);
        $project_flow->save();

        // Update the process_status in the concept_note table
        $conceptNote = ConceptNote::find($this->conceptID);
        if ($conceptNote) {
            $conceptNote->process_status = 1;
            $conceptNote->save();
        }

        $this->dispatch('swal:info', title: 'Successfully Sent');
           //close modal
           $this->dispatch('closeModal');
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Ministry User Deleted');
    }
    public function render()
    {
        // $decision = DecisionFlow::where('conceptnote_id', );

        // $ConceptNote = ConceptNote::query()->where('process_status', 10)->orWhere('process_status', 0)->orderBy('id', 'desc');
        // $ConceptNote = ConceptNote::query()
        //             ->where(function ($query) {
        //                 $query->where('process_status', 10)
        //                     ->orWhere('process_status', 0);
        //             })
        //             ->where('type', 'National Concept Note')
        //             ->orderBy('id', 'desc');

        // $ConceptNote = ConceptNote::with('decisionFlows') // Eager loading DecisionFlows
        //             ->where(function ($query) {
        //                 $query->where('process_status', 10)
        //                       ->orWhere('process_status', 0);
        //             })
        //             ->where('type', 'National Concept Note')
        //             ->orderBy('id', 'desc');

        $ConceptNote = ConceptNote::with('decisionFlows') // Eager loading DecisionFlows
                    ->whereIn('process_status', [0, 1, 2, 3, 4, 5, 10]) // Checking for multiple status values
                    ->where('type', 'National Concept Note')
                    ->orderBy('id', 'desc');
                    // Order by creation time, latest first

        if ($this->search_keyword) {
            $ConceptNote->where('id', $this->search_keyword)
                ->orWhere('projectname', 'like', '%' . $this->search_keyword . '%');
        }
        $ConceptNote = $ConceptNote->paginate();

        return view('livewire.concept-note-component', ['conceptnote' => $ConceptNote
        ])->layout('layouts.app');
    }
}
