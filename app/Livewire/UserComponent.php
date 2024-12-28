<?php

namespace App\Livewire;

use App\Mail\UserCreatedPasswordMail;
use App\Models\Role;
use App\Models\Station;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $extend_confirm = null;
    public $change_password = false;
    public $userId;

    public $name, $username, $email, $password,  $password_confirmation, $user_id, $status, $role = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {

        if ($this->update) {
            $this->validate([
                'name' => 'required',
                'status' => 'required|in:active,inactive',
                'password' => 'required_if:change_password,1|confirmed'
            ]);

            $user =  User::find($this->user_id);
            if ($this->change_password) {
                $user->password = Hash::make($this->password);
            }
            $user->name = $this->name;
            $user->status = $this->status;
            $user->save();
        } else {
            $this->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required',
                'password' => 'required|confirmed|min:8',
                'status' => 'required|in:active,inactive',
            ]);

            $user =  User::create([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'status' => $this->status,
            ]);
        }


        $user->syncRoles($this->role);

        $this->dispatch(
            'swal:info',
            ['title' => 'success', 'text' => $this->user_id ? 'User Updated.' : 'User Created']
        );

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($user_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->user_id = $user_id;

        $user = User::findOrFail($user_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role =  $user->getRoleNames()[0] ?? null;
        $this->status = $user->status;
    }

    public function deleteConfirm(User $user)
    {
        $this->delete_confirm = $user;
    }



    public function extendTimeConfirm($userId)
    {
        $this->userId = $userId;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', ['title' => 'success', 'text' => 'User Deleted']);
    }

    private function resetField()
    {
        $this->reset('name', 'email', 'password', 'user_id', 'update', 'username', 'role');
    }

    public function extendTokenTime()
    {
        $user = User::find($this->userId);
        if ($user) {
            $token = Password::broker()->createToken($user);

            DB::table('password_resets')->updateOrInsert(
                ['email' => $user->email],
                ['token' => $token, 'created_at' => Carbon::now()]
            );
            Mail::to($user->email)->send(new UserCreatedPasswordMail($user, $token));

            $this->dispatch('swal:info', title: 'Reset successfully.');
        } else {
            $this->dispatch('swal:info', title: 'User not found.');
        }

        $this->resetModal();
    }

    private function resetModal()
    {
        $this->userId = null;
        $this->dispatch('extendTimeTokenModel'); // Close the modal
    }

    public function render()
    {
        $users = User::query()->latest();
        if ($this->search_keyword) {
            $users->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('email', 'like', '%' . $this->search_keyword . '%')
                ->orWhere('password', 'like', '%' . $this->search_keyword . '%');
        }

        $users = $users->paginate();


        return view('livewire.user-component', [
            'users' => $users,
            'roles' => Role::get()
        ])->layout('layouts.app');
    }
}
