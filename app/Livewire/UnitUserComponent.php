<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Unit;
use App\Models\UnitUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UnitUserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $full_name,$email,$phone,$employmentId,$department,$address,$unit, $unituser_id, $user_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id . ',id',
            'phone' => 'required|numeric',
            'employmentId' => 'required|unique:unit_users,employmentID,' . $this->unituser_id . ',id',
            'department' => 'required',
            'address' => 'required',
            'unit' => 'required',
        ]);
        $user = User::updateOrCreate(['id' => $this->user_id],[
                'name' => explode(' ', trim($this->full_name))[0],
                'email' => $this->email,
                'password' => Hash::make('unit@'. date('Y')),
            ]
        );
        UnitUser::updateOrCreate(['id' => $this->unituser_id],[
            'user_id' => $user->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'employmentID' => $this->employmentId,
            'department_id' => $this->department,
            'address' => $this->address,
            'unit_id' => $this->unit,
        ]);

        $this->dispatch('swal:info', title: $this->unituser_id ? 'Unit User Updated.' : 'Unit User Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($unituser_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->unituser_id = $unituser_id;

        $unituser = UnitUser::findOrFail($unituser_id);
        $this->full_name = $unituser->full_name;
        $this->email = $unituser->user->email;
        $this->user_id = $unituser->user->id;
        $this->phone = $unituser->phone;
        $this->employmentId = $unituser->employmentID;
        $this->department = $unituser->department_id;
        $this->address = $unituser->address;
        $this->unit = $unituser->unit_id;
    }

    public function deleteConfirm(UnitUser $unituser){
        $this->delete_confirm = $unituser;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Unit User Deleted');
    }

    private function resetField(){
        $this->reset('full_name','email','phone','employmentId','department','address','unit', 'unituser_id', 'user_id' , 'update');
    }

    public function render()
    {
        $unit_users = UnitUser::query()->latest();
        if ($this->search_keyword) {
            $unit_users->where('id', $this->search_keyword)
                ->orWhere('full_name', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('phone', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('employmentID', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('address', 'like', '%' . $this->search_keyword . '%')
                ->orWhereHas('user', function ($query) {
                    $query->where('email', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('department', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('unit', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                });
        }


        $unitusers = $unit_users->paginate();


        return view('livewire.unit-user-component', [
            'unitusers' => $unitusers,
            'units' => Unit::all(),
            'departments' => Department::all(),
        ])->layout('layouts.app');
    }
}
