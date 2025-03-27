<?php

namespace App\Livewire;

use App\Mail\UserCreatedPasswordMail;
use App\Models\Role;
use App\Models\Station;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

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

    public $fullname, $username, $email, $password,  $password_confirmation, $user_id, $phoneNumber, $institution, $ministry, $organizationId, $organization, $isPrivate, $isActive, $role = null;
    public $institutions = [], $ministries = [], $departments = [], $organizationType;

    public function create()
    {
        $this->resetField();
    }

    public function mount()
    {
        $baseUrl = $this->getBaseUrl();

        $ministryResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/ministry");

        $this->ministries = collect([]);
        if ($ministryResponse->successful()) {
            $ministryData = $ministryResponse->json()['data'];
            $this->ministries = collect($ministryData)->map(function ($ministry) {
                return (object) [
                    'id' => $ministry['id'],
                    'name' => $ministry['ministryName'],
                ];
            });
        } else {
            logger()->error('Error Fetching ministry Types:', ['response' => $ministryResponse->body()]);
        }


        $institutionResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/institution");

        $this->institutions = collect([]);
        if ($institutionResponse->successful()) {
            $institutionData = $institutionResponse->json()['data'];
            $this->institutions = collect($institutionData)->map(function ($institute) {
                return (object) [
                    'id' => $institute['id'],
                    'name' => $institute['instituteName'],
                ];
            });
        } else {
            logger()->error('Error Fetching institution:', ['response' => $institutionResponse->body()]);
        }
    }



    private function getBaseUrl()
    {
        return config('services.api.base_url');
    }

    public function store()
    {
        $this->validate([
            'username' => 'required|min:5|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phoneNumber' => 'required|digits_between:10,15|unique:users,phoneNumber',
            'fullname' => 'required|string|max:255',
            // 'isPrivate' => 'required|boolean',
        ]);


        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->user_id ? "{$baseUrl}/users/{$this->user_id}" : "{$baseUrl}/users/register";
        $method = $this->user_id ? 'put' : 'post';

        $token = session('token');
        // Convert isActive from string to boolean
        $isActiveBool = $this->isActive === '1' ? true : false;
        // API request to external endpoint
        $payload = [
            'username' => $this->username,
            'fullName' => $this->fullname,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'password' => Hash::make($this->password),
            'organizationType' => $this->organizationType,
            'organizationId' => $this->organization,
            'role' => $this->role,
            'isPrivate' => true,
            'isActive' => $isActiveBool,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);



        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['username' => $this->username, 'isActive' => $this->isActive, 'organizationType' => $this->organizationType]);
            $this->dispatch('swal:info', title: $this->user_id ? 'User Updated.' : 'User Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the User: {$response->body()}");
            session()->flash('error', 'Failed to create or update the User on the external server.');
            $this->dispatch('swal:info', title: $this->user_id ? 'Error while updating User.' : 'Error while creating User');
        }
    }


    public function edit($user_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->user_id = $user_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/users/{$user_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            // logger()->info('User Data:', $responseBody);
            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $userData = $responseBody['data']; // Assuming the first element is what you want
                $this->fullname = $userData['fullName'] ?? 'No user name provided';
                $this->username = $userData['username'] ?? 'No username provided';
                $this->email = $userData['email'] ?? 'No email  provided';
                $this->phoneNumber = $userData['phoneNumber'] ?? 'No phone number provided';
                $this->isPrivate = $userData['isPrivate'] ?? 'No status provided';

                // logger()->info('User Data:', [
                //     'fullname' => $this->fullname,
                //     'username' => $this->username,
                //     'email' => $this->email,
                //     'phoneNumber' => $this->phoneNumber,
                // ]);
            } else {
                logger()->error("Failed to load load user: {$response->body()}");
                session()->flash('error', 'No user data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load user: {$response->body()}");
            session()->flash('error', 'Failed to fetch user details. Error: ' . $response->body());
        }
    }


    public function extendTimeConfirm($userId)
    {
        $this->userId = $userId;
    }



    public function deleteConfirm($userId)
    {
        $this->delete_confirm = $userId;
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/users/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'User Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete User: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the User.');
            }
        }
        $this->dispatch('closeModal');
    }


    private function resetField()
    {
        $this->reset('fullname', 'email', 'organization', 'password', 'user_id', 'update', 'username', 'institution', 'ministry', 'role', 'phoneNumber', 'organizationId', 'isPrivate', 'organizationType', 'isActive');
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

    public function paginateCollection($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->all(), // Ensure items are an array
            $items->count(), // Total number of items
            $perPage,
            $page,
            $options
        );
    }


    public function render()
    {
        $query = [];
        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }

        $baseUrl = $this->getBaseUrl();
        // Assuming the token is stored in the session, you can retrieve it like this:
        $token = session('token'); // Ensure you have set this session variable when you login

        if (!$token) {
            session()->flash('error', 'No authentication token available. Please login again.');
            return view('livewire.user-component', ['users' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/users", $query);

        $users = collect([]);

        if ($response->successful()) {
            $usersData = $response->json()['data'];
            // logger()->info('Fetched users:', $usersData);
            $users = collect($usersData)->map(function ($user) {
                return (object) [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'fullName' => $user['fullName'],
                    'phoneNumber' => $user['phoneNumber'],
                    'email' => $user['email'],
                    'isActive' => $user['isActive'],
                    'roleName' => $user['role']['roleName'], // Extracting roleName
                ];
            });

            // Apply pagination
            $users = $this->paginateCollection($users, 10);
        } else {
            session()->flash('error', 'Failed to fetch users from the server.');
            // logger()->error('Error Fetching users:', ['response' => $response->body()]);
        }


        $rolesResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/roles");

        $roles = collect([]);
        if ($rolesResponse->successful()) {
            $roleData = $rolesResponse->json()['data'];
            // logger()->info('Fetched Roles:', $roleData);
            $roles = collect($roleData)->map(function ($role) {
                return (object) [
                    'id' => $role['id'],
                    'name' => $role['roleName'],
                ];
            });
        } else {
            logger()->error('Error Fetching roles:', ['response' => $rolesResponse->body()]);
        }


        return view('livewire.user-component', [
            'users' => $users,
            'roles' => $roles
        ])->layout('layouts.app');
    }
}
