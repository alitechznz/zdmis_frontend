<?php

namespace App\Livewire;

use App\Mail\UserCreatedPasswordMail;
use App\Models\Ministry;
use App\Models\MinistryUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\WithPagination;

class MinistryUserComponent extends Component
{
    use WithPagination;

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $full_name, $email, $phone, $employmentid, $ministry, $address, $ministry_user_id, $user_id = null;
    public $roles = [], $role = null;
    protected $paginationTheme = 'bootstrap';

    public function create()
    {
        $this->resetField();
        $this->roles = Role::all();
    }

    private function resetField()
    {
        $this->reset('full_name', 'email', 'phone', 'employmentid', 'ministry', 'address', 'ministry_user_id', 'update');
    }

    public function store()
    {
        $this->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id . ',id',
            'phone' => 'required|numeric',
            'employmentid' => 'required|unique:ministry_users,employmentID,' . $this->ministry_user_id . ',id',
            'ministry' => 'required|exists:ministries,id',
            'address' => 'required',
        ]);

        $user = User::updateOrCreate(
            ['id' => $this->user_id],
            [
                'name' => explode(' ', trim($this->full_name))[0],
                'email' => $this->email,
                'password' => Hash::make('ministry@' . date('Y')),
                'org_type' => "Ministry",
            ]
        );

        $user->syncRoles($this->role);

        MinistryUser::updateOrCreate(['id' => $this->ministry_user_id], [
            'user_id' => $user->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'employmentID' => $this->employmentid,
            'ministry_id' => $this->ministry,
            'address' => $this->address,
        ]);

        // Generate reset password token
        $token = Password::broker()->createToken($user);
        // After user creation logic
        Mail::to($user->email)->send(new UserCreatedPasswordMail($user, $token));
        $this->dispatch('swal:info', title: $this->ministry_user_id ? 'Ministry User Updated.' : 'Ministry User Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($ministry_user_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->ministry_user_id = $ministry_user_id;

        $ministry_user = MinistryUser::findOrFail($ministry_user_id);
        $this->roles = Role::all();
        $this->role =  $ministry_user->user->roles[0]->name ?? null;
        $this->full_name = $ministry_user->full_name;
        $this->email = $ministry_user->user->email;
        $this->user_id = $ministry_user->user->id;
        $this->phone = $ministry_user->phone;
        $this->employmentid = $ministry_user->employmentID;
        $this->ministry = $ministry_user->ministry->id;
        $this->address = $ministry_user->address;
    }

    public function deleteConfirm(MinistryUser $ministry_user)
    {
        $this->delete_confirm = $ministry_user;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Ministry User Deleted');
    }

    public function render()
    {
        $ministry_users = MinistryUser::query()->with(['ministry', 'user'])->latest();
        if ($this->search_keyword) {
            $ministry_users->where('id', $this->search_keyword)
                ->orWhere('full_name', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('phone', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('employmentID', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('address', 'like', '%' . $this->search_keyword . '%')
                ->orWhereHas('ministry', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('user', function ($query) {
                    $query->where('email', 'like', '%' . $this->search_keyword . '%');
                });
        }

        $ministry_users = $ministry_users->paginate();


        return view('livewire.ministry-user-component', [
            'ministry_users' => $ministry_users,
            'ministries' => Ministry::all(),
        ])->layout('layouts.app');
    }
}
