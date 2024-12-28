<?php

namespace App\Livewire;

use App\Mail\UserCreatedPasswordMail;
use App\Models\Department;
use App\Models\Region;
use App\Models\RDCUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\WithPagination;

class RdcUserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $roles = [], $role = null;
    public $full_name, $email, $phone, $employmentId, $address, $region, $rdcuser_id, $user_id = null;

    public function create()
    {
        $this->resetField();
        $this->roles = Role::all();
    }

    public function store()
    {
        $this->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id . ',id',
            'phone' => 'required|numeric',
            'employmentId' => 'required|unique:rdc_users,employmentID,' . $this->rdcuser_id . ',id',
            'address' => 'required',
            'region' => 'required',
        ]);
        $user = User::updateOrCreate(
            ['id' => $this->user_id],
            [
                'name' => explode(' ', trim($this->full_name))[0],
                'email' => $this->email,
                'password' => Hash::make('rdc@' . date('Y')),
            ]
        );
        $user->syncRoles($this->role);
        RDCUser::updateOrCreate(['id' => $this->rdcuser_id], [
            'user_id' => $user->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'employmentID' => $this->employmentId,
            'address' => $this->address,
            'region_id' => $this->region,
        ]);
        // Generate reset password token
        $token = Password::broker()->createToken($user);
        // After user creation logic
        Mail::to($user->email)->send(new UserCreatedPasswordMail($user, $token));
        $this->dispatch('swal:info', title: $this->rdcuser_id ? 'Rdc User Updated.' : 'Rdc User Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($rdcuser_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->rdcuser_id = $rdcuser_id;

        $rdcuser = RDCUser::findOrFail($rdcuser_id);
        $this->roles = Role::all();
        $this->role =  $rdcuser->user->getRoleNames()[0] ?? null;
        $this->full_name = $rdcuser->full_name;
        $this->email = $rdcuser->user->email;
        $this->user_id = $rdcuser->user->id;
        $this->phone = $rdcuser->phone;
        $this->employmentId = $rdcuser->employmentID;
        $this->address = $rdcuser->address;
        $this->region = $rdcuser->region_id;
    }

    public function deleteConfirm(RDCUser $rdcuser)
    {
        $this->delete_confirm = $rdcuser;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Rdc User Deleted');
    }

    private function resetField()
    {
        $this->reset('full_name','role', 'email', 'phone', 'employmentId', 'address', 'region', 'rdcuser_id', 'user_id', 'update');
    }

    public function render()
    {
        $rdcusers = RDCUser::query()->latest();
        if ($this->search_keyword) {
            $rdcusers->where('id', $this->search_keyword)
                ->orWhere('full_name', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('phone', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('employmentID', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('address', 'like', '%' . $this->search_keyword . '%')
                ->orWhereHas('user', function ($query) {
                    $query->where('email', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('region', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                });
        }


        $rdcusers = $rdcusers->paginate();


        return view('livewire.rdc-user-component', [
            'rdc_users' => $rdcusers,
            'regions' => Region::all(),
        ])->layout('layouts.app');
    }
}
