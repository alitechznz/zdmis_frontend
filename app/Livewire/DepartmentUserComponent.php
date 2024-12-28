<?php

namespace App\Livewire;

use App\Mail\UserCreatedPasswordMail;
use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\Institution;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentUserComponent extends Component
{
    use WithPagination;

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $roles = [], $role = null;
    public $full_name, $email, $phone, $employmentID, $department, $address, $institution, $departmentuser_id, $user_id = null;
    protected $paginationTheme = 'bootstrap';

    public function create()
    {
        $this->resetField();
        $this->roles = Role::all();
    }

    private function resetField()
    {
        $this->reset('full_name','role', 'email', 'phone', 'employmentID', 'department', 'address', 'institution', 'departmentuser_id', 'update');
    }

    public function store()
    {
        $this->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id . ',id',
            'phone' => 'required|numeric',
            'employmentID' => 'required|unique:department_users,employmentID,' . $this->departmentuser_id . ',id',
            'department' => 'required|exists:departments,id',
            'address' => 'required',
            'institution' => 'required|exists:institutions,id',
        ]);
        $user = User::updateOrCreate(['id' => $this->user_id],[
                'name' => explode(' ', trim($this->full_name))[0],
                'email' => $this->email,
                'password' => Hash::make('department@'. date('Y')),
            ]
        );
        $user->syncRoles($this->role);
        DepartmentUser::updateOrCreate(['id' => $this->departmentuser_id], [
            'user_id' => $user->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'employmentID' => $this->employmentID,
            'department_id' => $this->department,
            'address' => $this->address,
            'institution_id' => $this->institution,
        ]);
        // Generate reset password token
        $token = Password::broker()->createToken($user);
        // After user creation logic
        Mail::to($user->email)->send(new UserCreatedPasswordMail($user, $token));
        $this->dispatch('swal:info', title: $this->departmentuser_id ? 'Department User Updated.' : 'Department User Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($departmentuser_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->departmentuser_id = $departmentuser_id;

        $departmentuser = DepartmentUser::findOrFail($departmentuser_id);
        $this->roles = Role::all();
        $this->role =  $departmentuser->user->getRoleNames()[0] ?? null;
        $this->full_name = $departmentuser->full_name;
        $this->email = $departmentuser->user->email;
        $this->user_id = $departmentuser->user->id;
        $this->phone = $departmentuser->phone;
        $this->employmentID = $departmentuser->employmentID;
        $this->department = $departmentuser->department_id;
        $this->address = $departmentuser->address;
        $this->institution = $departmentuser->institution_id;
    }

    public function deleteConfirm(DepartmentUser $departmentuser)
    {
        $this->delete_confirm = $departmentuser;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Department User Deleted');
    }

    public function render()
    {
        $departmentusers = DepartmentUser::query()->with(['user', 'department', 'institution'])->latest();
        if ($this->search_keyword) {
            $departmentusers->where('id', $this->search_keyword)
                ->orWhere('full_name', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('phone', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('employmentID', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('address', 'like', '%' . $this->search_keyword . '%')
                ->orWhereHas('department', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('institution', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('user', function ($query) {
                    $query->where('email', 'like', '%' . $this->search_keyword . '%');
                });
        }

        $departmentusers = $departmentusers->paginate();


        return view('livewire.department-user-component', [
            'departmentusers' => $departmentusers,
            'departments' => Department::all(),
            'institutions' => Institution::all(),
        ])->layout('layouts.app');
    }
}
