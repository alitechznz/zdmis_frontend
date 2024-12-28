<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $role = Role::findByName('Super Admin');

        $admin = User::updateOrCreate(['id' => 1],[
            "name" => "admin",
            "email" => "admin.zips@admin.com",
            "password" => Hash::make("zips1234")
        ]);

        $admin->syncRoles($role);
        $role->givePermissionTo(Permission::all());
    }
}
