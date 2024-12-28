<?php

namespace App\Livewire;
use App\Models\ConceptNote;
use App\Models\DecisionFlow;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\Component;

class ConceptNoteApprovalComponent extends Component
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
        // Update the concept note with the selected action and remark
        $conceptNote = ConceptNote::findOrFail($this->conceptID);
        $conceptNote->verification_status = $this->action;
        $conceptNote->verification_remark = $this->remark;
        $conceptNote->save();

        // Reset the fields
        $this->action = '';
        $this->remark = '';
        // Close the modal
        $this->dispatchBrowserEvent('closeModal', ['modalId' => 'modal-verifyconcept']);
        // Show a success message
        session()->flash('message', 'Concept note verification completed successfully!');
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
        $this->FeedbackStatus = 'Initiate';

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

        session()->flash('message', 'Concept note initiated successfully!');
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Ministry User Deleted');
    }

    public function render()
    {
         // $appraisalquestions = ProjectQuestion::query()->latest();
         $ConceptNote = ConceptNote::where('createdby', Auth::id())->where('process_status', 6);

         if ($this->search_keyword) {
             $ConceptNote->where('id', $this->search_keyword)
                 ->orWhere('projectname', 'like', '%' . $this->search_keyword . '%');
         }
         $ConceptNote = $ConceptNote->paginate();

        return view('livewire.concept-note-approval-component', ['conceptnote' => $ConceptNote
        ])->layout('layouts.app');
    }
}
