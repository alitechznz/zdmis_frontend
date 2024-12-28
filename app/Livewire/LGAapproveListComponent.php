<?php

namespace App\Livewire;

use App\Models\AddlgaApproveList;
use App\Models\ConceptNote;
use App\Models\SourceFinancing;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class LGAapproveListComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $characterCount = 0;

    public $source_of_fund, $concept_note, $project_cost, $location_level, $start_time_period, $end_time_period, $implementation_status,  $sector, $attachment, $description, $lga_approve_id = null;




    public function create()
    {
        $this->resetField();
    }


    public function store()
    {
        $this->validate([
            'source_of_fund' => 'required',
            'concept_note' => 'required',
            'location_level' => 'required',
            'project_cost' => 'required',
            'start_time_period' => 'required',
            'end_time_period' => 'required',
            'implementation_status' => 'required',
        ]);

            AddlgaApproveList::updateOrCreate(['id' => $this->lga_approve_id], [
                'source_of_fund_id' => $this->source_of_fund,
                'concept_note_id' => $this->concept_note,
                'location_level' => $this->location_level,
                'project_cost' => $this->project_cost,
                'start_time_period' => $this->start_time_period,
                'end_time_period' => $this->end_time_period,
                'implementation_status' => $this->implementation_status,
            ]);

            $this->dispatch('swal:info', title: $this->lga_approve_id ? 'LGA Approve Updated.' : 'LGA Approve Created');

            $this->resetField();

            //close modal
            $this->dispatch('closeModal');
        }

    public function edit($lga_approve_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->lga_approve_id = $lga_approve_id;

        $lgaApprove = AddlgaApproveList::findOrFail($lga_approve_id);
        $this->source_of_fund = $lgaApprove->source_of_fund_id;
        $this->concept_note = $lgaApprove->concept_note_id;
        $this->location_level = $lgaApprove->location_level;
        $this->project_cost = $lgaApprove->project_cost;
        $this->start_time_period = $lgaApprove->start_time_period;
        $this->end_time_period = $lgaApprove->end_time_period;
        $this->implementation_status = $lgaApprove->implementation_status;
    }

    public function deleteConfirm(AddlgaApproveList $lga_approve)
    {
        $this->delete_confirm = $lga_approve;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'LGA Approve Deleted');
    }

    private function resetField()
    {
        $this->reset('end_time_period', 'implementation_status', 'start_time_period', 'project_cost', 'lga_approve_id', 'update', 'location_level', 'concept_note', 'source_of_fund');
    }




    public function render()
    {
        $all_data = AddlgaApproveList::query()->latest();
        if ($this->search_keyword) {
            $all_data->where('id', $this->search_keyword)
                ->orWhere('title', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $all_data = $all_data->paginate();
        return view('livewire.lga-approve-list-component', [
            'all_data' => $all_data,
            'conceptNote' => ConceptNote::all(),
            'sourceFinancings' => SourceFinancing::all(),
        ])->layout('layouts.app');
    }
}
