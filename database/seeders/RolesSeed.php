<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        DB::table('roles')->delete();
        DB::table('model_has_permissions')->delete();

        $roles = array(
            array('name' => 'Super admin', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'Admin', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'ZPC Officer', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'Chairman ZPC', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'DPPR', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'PS', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'Minister', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        );
        DB::table('roles')->insert($roles);
    }
}
