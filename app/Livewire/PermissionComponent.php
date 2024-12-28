<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionComponent extends Component
{
    public  $selected_permissions = [];
    public  $update = false;

    public $listeners = ['perms' => 'setRole'];
    public $role;

    public function setRole(\App\Models\Role $role)
    {
        $this->role =  $role;
        foreach($role->permissions as $userPermission){
            $this->selected_permissions[] = $userPermission->name;
        }
    }

    public function store()
    {
        $this->role->syncPermissions($this->selected_permissions);
        $this->dispatch('swal:info', title: 'Permissions Updated');
    }

    public function render()
    {
        return view('livewire.permission-component', [
            'permissions' => Permission::get(),
            'groups' => Permission::distinct()->orderBy('group')->get("group"),
        ]);
    }
}
