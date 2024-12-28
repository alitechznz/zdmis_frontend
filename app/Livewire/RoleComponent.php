<?php

namespace App\Livewire;

use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class RoleComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $role_name, $role_edit;

    public function storeRole()
    {
        $this->validate([
            'role_name' => ['required',
                Rule::unique('roles', 'name')->ignore($this->role_edit)],
        ]);

        Role::updateOrCreate(['id' => $this->role_edit], [
            'name' => $this->role_name,
        ]);

        $this->update = false;
        $this->reset('role_name', 'role_edit');

        $this->dispatch('swal:info', title: 'Role Added');
    }

    public function removeRole(Role $role)
    {
        if($role->users()->count() > 0){
            $this->dispatch('swal:error', title: 'Role In Use');
            return false;
        }


        $role->delete();
        $this->dispatch('swal:info', title: 'Role Deleted');
    }

    public function editRole(Role $role)
    {
        $this->role_name = $role->name;
        $this->role_edit = $role->id;

        $this->update = true;
    }

    public function deleteConfirm(Role $role)
    {
        $this->delete_confirm = $role;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Role Deleted');
    }

    public function render()
    {
        return view('livewire.role-component', [
            'roles' => Role::get()
        ])->layout('layouts.app');
    }
}
