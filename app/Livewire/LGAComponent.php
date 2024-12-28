<?php

namespace App\Livewire;

use App\Models\AddLgaChallenge;
use App\Models\BudgetTerm;
use App\Models\District;
use App\Models\Sector;
use App\Models\User;
use App\Models\Shehia;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class LGAComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $characterCount = 0;
    public $district_id;


    public $title, $date_identified,$district, $priority_level, $status, $shehia, $identified_by_name, $identified_by_id,  $sector, $attachment, $potential_solution, $resource_needed, $community_feedback, $expected_outcome, $description, $identified_by, $lga_challenge_id = null;


    public function mount()
    {
        $this->identified_by_name = auth()->user()->name;
        $this->identified_by_id = auth()->user()->id;
    }


    public function getByDistrict($districtId)
    {
        return Shehia::where('district_id', $districtId)->where('status', 'active')->get();
    }




    public function create()
    {
        $this->resetField();
    }

    public function updatedPotentialSolution()
    {
        $this->characterCount = strlen($this->potential_solution);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'date_identified' => 'required',
            'priority_level' => 'required',
            'status' => 'required',
            'shehia' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'attachment' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'potential_solution' => 'required',
            'resource_needed' => 'required',
            'community_feedback' => 'required',
            'expected_outcome' => 'required',
            'description' => 'required',
            'identified_by_id' => 'required',
        ]);

        if ($this->attachment) {
            // Generate a unique file name with the attachment title and a timestamp
            $filename = $this->date_identified . '_' . time() . '.' . $this->attachment->getClientOriginalExtension();

            // Store the file in the 'public' disk under 'financing_agreement_docs' directory with the custom filename
            $filePath = $this->attachment->storeAs('lgaChallengeAttachments', $filename, 'public');

            AddLgaChallenge::updateOrCreate(['id' => $this->lga_challenge_id], [
                'title' => $this->title,
                'date_identified' => $this->date_identified,
                'priority_level' => $this->priority_level,
                'status' => $this->status,
                'shehia_id' => $this->shehia,
                'district_id' => $this->district,
                'sector_id' => $this->sector,
                'attachment' => $filePath,
                'potential_solution' => $this->potential_solution,
                'resource_needed' => $this->resource_needed,
                'community_feedback' => $this->community_feedback,
                'expected_outcome' => $this->expected_outcome,
                'description' => $this->description,
                'identified_by' => $this->identified_by_id,
            ]);

            $this->dispatch('swal:info', title: $this->lga_challenge_id ? 'LGA Challenge Updated.' : 'LGA Challenge Created');

            $this->resetField();

            //close modal
            $this->dispatch('closeModal');
        }
    }

    public function downloadAttachment($id)
    {
        $lgaChallenge = AddLgaChallenge::findOrFail($id);
        if ($lgaChallenge && Storage::disk('public')->exists($lgaChallenge->attachment)) {
            return response()->download(storage_path('app/public/' . $lgaChallenge->attachment));
        } else {
            session()->flash('error', 'File does not exist.');
            return redirect()->back();
        }
    }


    public function edit($lga_challenge_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->lga_challenge_id = $lga_challenge_id;

        $lgaChallenge = AddLgaChallenge::findOrFail($lga_challenge_id);
        $this->title = $lgaChallenge->title;
        $this->date_identified = $lgaChallenge->date_identified;
        $this->priority_level = $lgaChallenge->priority_level;
        $this->status = $lgaChallenge->status;
        $this->shehia = $lgaChallenge->shehia_id;
        $this->district = $lgaChallenge->district_id;
        $this->sector = $lgaChallenge->sector_id;
        $this->attachment = $lgaChallenge->attachment;
        $this->potential_solution = $lgaChallenge->potential_solution;
        $this->resource_needed = $lgaChallenge->resource_needed;
        $this->community_feedback = $lgaChallenge->community_feedback;
        $this->expected_outcome = $lgaChallenge->expected_outcome;
        $this->description = $lgaChallenge->description;
        $this->identified_by = $lgaChallenge->identified_by;
    }

    public function deleteConfirm(AddLgaChallenge $lga_challenge)
    {
        $this->delete_confirm = $lga_challenge;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'LGA Challenge Deleted');
    }

    private function resetField()
    {
        $this->reset('title', 'date_identified', 'priority_level','district', 'status', 'lga_challenge_id', 'update', 'shehia', 'attachment', 'sector', 'potential_solution', 'resource_needed', 'community_feedback', 'expected_outcome', 'description', 'identified_by');
    }




    public function render()
    {
        $lga_challenges = AddLgaChallenge::query()->latest();
        if ($this->search_keyword) {
            $lga_challenges->where('id', $this->search_keyword)
                ->orWhere('title', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $lga_challenges = $lga_challenges->paginate();
        return view('livewire.lga-challenges-component', [
            'lga_challenges' => $lga_challenges,
            'districts' => District::where('status', 'active')->get(),
            'sectors' => Sector::all(),
        ])->layout('layouts.app');
    }
}
