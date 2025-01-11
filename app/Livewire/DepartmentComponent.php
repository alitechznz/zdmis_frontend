<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Institution;
use App\Models\Ministry;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $ministry_address = null;

    // public $name, $institution, $address, $department_id = null;
    public $name, $under, $institution_id, $vote_number, $web_url, $status, $institution, $ministry, $address, $department_id = null;
    public $institutions = [], $ministries = [];




    public function mount()
    {
        $this->ministries = Ministry::all();
   
        // $this->$ministry_address = $this->ministries->address;
        $this->institutions = Institution::all();
    }


    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'required|max:3000',
            'status' => 'required',
            'under' => 'required',
        ]);
        Department::updateOrCreate(['id' => $this->department_id], [
            'name' => $this->name,
            'institution_id' => $this->institution,
            'ministry_id' => $this->ministry,
            'address' => $this->address,
            'web_url' => $this->web_url,
            'under' => $this->under,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->department_id ? 'Department Updated.' : 'Department Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($department_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->department_id = $department_id;

        $department = Department::findOrFail($department_id);
        $this->name = $department->name;
        $this->institution = $department->institution_id;
        $this->ministry = $department->ministry_id;
        $this->address = $department->address;
        // $this->vote_number = $department->vote_number;
        $this->web_url = $department->web_url;
        $this->under = $department->under;
        $this->status = $department->status;
    }

    public function deleteConfirm(Department $department)
    {
        $this->delete_confirm = $department;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Department Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'institution', 'address', 'ministry', 'department_id', 'update', 'web_url', 'under', 'status', 'vote_number');
    }


    public function render()
    {
        $departments = Department::query()->latest();
        if ($this->search_keyword) {
            $departments->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('institution_id', 'like', '%' . $this->search_keyword . '%')->orWhere('address', 'like', '%' . $this->search_keyword . '%');
        }

        $departments = $departments->paginate();


        return view('livewire.department-component', [
            'departments' => $departments,
            'institutions' => Institution::all(),
            'ministries' => Ministry::all(),
        ])->layout('layouts.app');
    }
}
