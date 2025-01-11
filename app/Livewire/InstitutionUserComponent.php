<?php

namespace App\Livewire;

use App\Mail\UserCreatedPasswordMail;
use App\Models\Institution;
use App\Models\Ministry;
use App\Models\InstitutionUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\WithPagination;

class InstitutionUserComponent extends Component
{
    use WithPagination;

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $roles = [], $role = null;
    public $full_name, $email, $phone, $employmentid, $ministry, $address, $institution_user_id, $institution, $user_id = null;
    protected $paginationTheme = 'bootstrap';


    public function create()
    {
        $this->resetField();  // Ensures all fields are reset when opening the form to add a new entry
        // $this->update = false; // Ensure this is reset so the form knows it's not an update operation
        $this->roles = Role::all();
    }

    private function resetField()
    {
        $this->reset('full_name','role', 'email', 'phone', 'employmentid', 'ministry', 'address', 'institution_user_id', 'update');
    }

    public function store()
    {
        $this->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id . ',id',
            'phone' => 'required|numeric',
            'employmentid' => 'required|unique:institution_users,employmentID,' . $this->institution_user_id . ',id',
            'ministry' => 'required|exists:ministries,id',
            'institution' => 'required|exists:institutions,id',
            'address' => 'required',
        ]);

        $user = User::updateOrCreate(['id' => $this->user_id],[
                'name' => explode(' ', trim($this->full_name))[0],
                'email' => $this->email,
                'password' => Hash::make('institution@'. date('Y')),
            ]
        );
        $user->syncRoles($this->role);

        InstitutionUser::updateOrCreate(['id' => $this->institution_user_id], [
            'user_id' => $user->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'employmentID' => $this->employmentid,
            'ministry_id' => $this->ministry,
            'institution_id' => $this->institution,
            'address' => $this->address,
        ]);
        // Generate reset password token
        $token = Password::broker()->createToken($user);
        // After user creation logic
        Mail::to($user->email)->send(new UserCreatedPasswordMail($user, $token));
        $this->dispatch('swal:info', title: $this->institution_user_id ? 'institution User Updated.' : 'institution User Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($institution_user_id)
    {
        $this->resetErrorBag();
        $this->update = true; // Set this to true to indicate you're in update mode
        $this->institution_user_id = $institution_user_id;

        $institution_user = InstitutionUser::findOrFail($institution_user_id);
        $this->roles = Role::all();
        $this->role =  $institution_user->user->getRoleNames()[0] ?? null;
        $this->full_name = $institution_user->full_name;
        $this->email = $institution_user->user->email;
        $this->user_id = $institution_user->user->id;
        $this->phone = $institution_user->phone;
        $this->employmentid = $institution_user->employmentID;
        $this->ministry = $institution_user->ministry->id;
        $this->institution = $institution_user->institution?->id;
        $this->address = $institution_user->address;
    }

    public function closeModal()
    {
        $this->resetField();
        $this->dispatch('closeModal'); // Make sure this method exists and is triggered on modal close
    }

    public function deleteConfirm(InstitutionUser $institution_user)
    {
        $this->delete_confirm = $institution_user;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'institution User Deleted');
    }

    public function render()
    {
        $institution_users = InstitutionUser::query()->with(['ministry', 'user', 'institution'])->latest();
        if ($this->search_keyword) {
            $institution_users->where('id', $this->search_keyword)
                ->orWhere('full_name', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('phone', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('employmentID', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('address', 'like', '%' . $this->search_keyword . '%')
                ->orWhereHas('user', function ($query) {
                    $query->where('email', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('ministry', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('institution', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                });
        }

        $institution_users = $institution_users->paginate();


        return view('livewire.institution-user-component', [
            'institution_users' => $institution_users,
            'ministries' => Ministry::all(),
            'institutions' => Institution::all(),
        ])->layout('layouts.app');
    }
}
