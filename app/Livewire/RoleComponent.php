<?php

namespace App\Livewire;

use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoleComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $role_name, $role_edit;
    public $roleName;
    public $status = true;
    public $roles;
    public $roleId;

    public function mount()
    {
        $this->fetchRoles(); // Fetch roles on mount
    }

    public function fetchRoles()
    {
        $baseUrl = config('services.api.base_url');
        $token = session('token');  // Retrieve the token from the session

        // Make sure to include the token in the Authorization header
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get("{$baseUrl}/roles");


        if ($response->successful()) {
            $this->roles = $response->json()['data'] ?? [];
        } else {
            // Handle the case where the token might be expired or invalid
            // $this->emit('error', 'Failed to fetch roles. Please check authentication.');
            $this->roles = [];  // Clear the roles if the fetch is unsuccessful
        }
    }


    public function storeRole()
    {

        $this->validate([
            'role_name' => 'required|string|min:3', // Validate role name is not empty and at least 3 characters
            'status' => 'required|boolean', // Validate status is boolean
        ]);


        $baseUrl = config('services.api.base_url');
        $token = session('token');


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post("{$baseUrl}/roles", [
            'roleName' => $this->role_name,
            'status' => $this->status,
        ]);

        if ($response->successful()) {
            // session()->flash('message', 'Role added successfully');
            $this->update = false;
            $this->reset('role_name', 'role_edit');
            $this->resetInput();
        } else {
            $this->update = false;
            $this->reset('role_name', 'role_edit');
            session()->flash('error', 'Error adding role: ' . $response->body());

        }
    }

    private function resetInput()
    {
        $this->roleId = null;
        $this->roleName = '';
        $this->status = true;
    }

    public function confirmDelete($id)
    {
        $this->roleId = $id;
    }

     /**
     * Update a role.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $baseUrl = config('services.api.base_url');
        $token = session('token'); // Assuming token is stored in session
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->put("{$baseUrl}/roles/{$id}", $request->all());

        if($response->successful()) {
            return response()->json([
                'message' => 'Role updated successfully',
                'data' => $response->json()
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to update role',
                'errors' => $response->json()
            ], $response->status());
        }
    }

    /**
     * Delete a role.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $baseUrl = config('services.api.base_url');
        $token = session('token'); // Assuming token is stored in session

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->delete("{$baseUrl}/roles/{$id}");

        if ($response->successful()) {
            return response()->json([
                'message' => 'Role deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to delete role',
                'errors' => $response->json()
            ], $response->status());
        }
    }

    // public function removeRole(Role $role)
    // {
    //     if($role->users()->count() > 0){
    //         $this->dispatch('swal:error', title: 'Role In Use');
    //         return false;
    //     }


    //     $role->delete();
    //     $this->dispatch('swal:info', title: 'Role Deleted');
    // }

    // public function editRole(Role $role)
    // {
    //     $this->role_name = $role->name;
    //     $this->role_edit = $role->id;

    //     $this->update = true;
    // }



    // public function deleteConfirm(Role $role)
    // {
    //     $this->delete_confirm = $role;
    // }

    // public function destroy()
    // {
    //     $this->delete_confirm->delete();
    //     $this->dispatch('swal:info', title: 'Role Deleted');
    // }

    public function editRole($id)
    {
        $role = $this->roles->firstWhere('id', $id);
        if ($role) {
            $this->roleId = $role['id'];
            $this->roleName = $role['roleName'];
            $this->status = $role['status'];
        }
    }

    public function render()
    {
        $this->fetchRoles();
        // dd($this->roles);
        return view('livewire.role-component', [
            'roles' => $this->roles
        ]);
    }
}
