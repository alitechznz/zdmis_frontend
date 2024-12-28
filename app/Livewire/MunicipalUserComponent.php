<?php

namespace App\Livewire;

use App\Mail\UserCreatedPasswordMail;
use App\Models\MunicipalUser;
use App\Models\MunicipalCouncil;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\WithPagination;

class MunicipalUserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $roles = [], $role = null;
    public $full_name,$email,$phone,$employeeId,$municipal,$address, $municipal_user_id, $user_id = null;

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
            'employeeId' => 'required|unique:municipal_users,employmentID,' . $this->municipal_user_id . ',id',
            'municipal' => 'required',
            'address' => 'required',
        ]);
        $user = User::updateOrCreate(
            ['id' => $this->user_id],
            [
                'name' => explode(' ', trim($this->full_name))[0],
                'email' => $this->email,
                'password' => Hash::make('municipal@' . date('Y')),
            ]
        );
        $user->syncRoles($this->role);
        MunicipalUser::updateOrCreate(['id' => $this->municipal_user_id],[
            'user_id' => $user->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'employmentID' => $this->employeeId,
            'municipal_council_id' => $this->municipal,
            'address' => $this->address,
        ]);

        // Generate reset password token
        $token = Password::broker()->createToken($user);
        // After user creation logic
        Mail::to($user->email)->send(new UserCreatedPasswordMail($user, $token));
        $this->dispatch('swal:info', title: $this->municipal_user_id ? 'Municipal User Updated.' : 'Municipal User Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($municipal_user_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->municipal_user_id = $municipal_user_id;

        $municipal_user = MunicipalUser::findOrFail($municipal_user_id);
        $this->roles = Role::all();
        $this->role =  $municipal_user->user->getRoleNames()[0] ?? null;
        $this->full_name = $municipal_user->full_name;
        $this->email = $municipal_user->user->email;
        $this->phone = $municipal_user->phone;
        $this->employeeId = $municipal_user->employmentID;
        $this->user_id = $municipal_user->user_id;
        $this->municipal = $municipal_user->municipal_council_id;
        $this->address = $municipal_user->address;
    }

    public function deleteConfirm(MunicipalUser $municipal_user){
        $this->delete_confirm = $municipal_user;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Municipal User Deleted');
    }

    private function resetField(){
        $this->reset('full_name','role','email','phone','employeeId','municipal','user_id','address', 'municipal_user_id' , 'update');
    }

    public function render()
    {
        $municipal_users = MunicipalUser::query()->with('re')->latest();
        if ($this->search_keyword) {
            $municipal_users->where('id', $this->search_keyword)
                ->orWhere('full_name', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('phone', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('employmentID', 'like', '%' . $this->search_keyword . '%')
                ->orWhereHas('user', function ($query) {
                    $query->where('email', 'like', '%' . $this->search_keyword . '%');
                })
                ->orWhereHas('municipal', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                });
        }

        $municipal_users = $municipal_users->paginate();


        return view('livewire.municipal-user-component', [
            'municipal_users' => $municipal_users,
            'municipals' => MunicipalCouncil::all()
        ])->layout('layouts.app');
    }
}
