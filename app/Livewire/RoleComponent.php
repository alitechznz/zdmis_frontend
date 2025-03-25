<?php

namespace App\Livewire;

use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class RoleComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $name, $role_edit, $role_id = null;
    public $roleName;
    public $status = true;
    public $roleId;

    public function mount()
    {
        // $this->fetchRoles();
    }

    private function getBaseUrl()
    {
        return config('services.api.base_url');
    }


    public function store()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->role_id ? "{$baseUrl}/roles/{$this->role_id}" : "{$baseUrl}/roles";
        $method = $this->role_id ? 'put' : 'post';

        $token = session('token');

        // API request to external endpoint
        $payload = [
            'roleName' => $this->name,
            'status' => in_array(strtolower($this->status), ['active', 'true', '1']), // safely cast to true/false
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);



        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['roleName' => $this->name, 'status' => $this->status]);
            $this->dispatch('swal:info', title: $this->role_id ? 'Role Updated.' : 'Role Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the Role: {$response->body()}");
            session()->flash('error', 'Failed to create or update the Role on the external server.');
            $this->dispatch('swal:info', title: $this->role_id ? 'Error while updating Role.' : 'Error while creating Role');
        }
    }


    public function edit($role_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->role_id = $role_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/roles/{$role_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            logger()->info('Roles Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $roleData = $responseBody['data']; // Assuming the first element is what you want
                $this->name = $roleData['roleName'] ?? 'No role name provided';
                $this->status = $roleData['status'] ?? 'No status provided';

                logger()->info('ministry Data:', [
                    'roleName' => $this->name,
                    'status' => $this->status,
                ]);
            } else {
                logger()->error("Failed to load load role: {$response->body()}");
                session()->flash('error', 'No role data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load role: {$response->body()}");
            session()->flash('error', 'Failed to fetch role details. Error: ' . $response->body());
        }
    }


    private function resetField()
    {
        $this->reset('name', 'status', 'role_id', 'update');
    }



    public function deleteConfirm($roleId)
    {
        $this->delete_confirm = $roleId;
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/roles/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Role Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Role: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Role.');
            }
        }
        $this->dispatch('closeModal');
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
            return view('livewire.role-component', ['roles' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/roles", $query);

        $roles = collect([]);

        if ($response->successful()) {
            $rolesData = $response->json()['data'];
            logger()->info('Fetched roles:', $rolesData);
            $roles = collect($rolesData)->map(function ($role) {
                return (object) [
                    'id' => $role['id'],
                    'name' => $role['roleName'],
                    'status' => $role['status'],
                ];
            });

            // Apply pagination
            $roles = $this->paginateCollection($roles, 10);
        } else {
            session()->flash('error', 'Failed to fetch roles from the server.');
            logger()->error('Error Fetching roles:', ['response' => $response->body()]);
        }

        return view('livewire.role-component', [
            'roles' => $roles
        ]);
    }
}
