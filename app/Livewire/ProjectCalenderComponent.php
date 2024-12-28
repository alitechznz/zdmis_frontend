<?php

namespace App\Livewire;

use App\Models\ProjectCalender;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class ProjectCalenderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $activity, $startdate, $enddate, $projectcalender_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'activity' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);
        ProjectCalender::updateOrCreate(['id' => $this->projectcalender_id], [
            'activity' => $this->activity,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
        ]);

        $this->dispatch('swal:info', title: $this->projectcalender_id ? 'ProjectCalender Updated.' : 'ProjectCalender Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($projectcalender_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->projectcalender_id = $projectcalender_id;

        $projectcalender = ProjectCalender::findOrFail($projectcalender_id);
        $this->activity = $projectcalender->activity;
        $this->startdate = $projectcalender->startdate;
        $this->enddate = $projectcalender->enddate;
    }

    public function deleteConfirm(ProjectCalender $projectcalender)
    {
        $this->delete_confirm = $projectcalender;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'ProjectCalender Deleted');
    }

    private function resetField()
    {
        $this->reset('activity', 'startdate', 'enddate', 'projectcalender_id', 'update');
    }



    public function render()
    {
        $projectcalenders = ProjectCalender::query()->latest();

        if ($this->search_keyword) {
            $projectcalenders->where('id', $this->search_keyword)
                ->orWhere('activity', 'like', '%' . $this->search_keyword . '%');
        }

        $projectcalenders = $projectcalenders->paginate(); // Use paginate directly

        return view('livewire.project-calender-component', [
            'projectcalenders' => $projectcalenders
        ])->layout('layouts.app');
    }
}
