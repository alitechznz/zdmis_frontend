<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = array(
            array('name' => 'system audit', 'group' => 'admin', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # user authentication
            array('name' => 'view user authentication', 'group' => 'authentication', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add user authentication', 'group' => 'authentication', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete user authentication', 'group' => 'authentication', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit user authentication', 'group' => 'authentication', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # user ministry
            array('name' => 'view user ministry', 'group' => 'user ministry', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add user ministry', 'group' => 'user ministry', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete user ministry', 'group' => 'user ministry', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit user ministry', 'group' => 'user ministry', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # user institution
            array('name' => 'view user institution', 'group' => 'user institution', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add user institution', 'group' => 'user institution', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete user institution', 'group' => 'user institution', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit user institution', 'group' => 'user institution', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # user department
            array('name' => 'view user department', 'group' => 'user department', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add user department', 'group' => 'user department', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete user department', 'group' => 'user department', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit user department', 'group' => 'user department', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # user municipal
            array('name' => 'view user municipal', 'group' => 'user municipal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add user municipal', 'group' => 'user municipal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete user municipal', 'group' => 'user municipal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit user municipal', 'group' => 'user municipal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # user institution
            array('name' => 'view user rd committee', 'group' => 'user rd committee', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add user rd committee', 'group' => 'user rd committee', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete user rd committee', 'group' => 'user rd committee', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit user rd committee', 'group' => 'user rd committee', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # role and permission
            array('name' => 'view role', 'group' => 'role and permission', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add role', 'group' => 'role and permission', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit role', 'group' => 'role and permission', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete role', 'group' => 'role and permission', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'permission role', 'group' => 'role and permission', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'sync permission', 'group' => 'role and permission', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # pillar
            array('name' => 'view pillar', 'group' => 'pillar', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add pillar', 'group' => 'pillar', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete pillar', 'group' => 'pillar', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit pillar', 'group' => 'pillar', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # plan
            array('name' => 'view plan', 'group' => 'plan', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add plan', 'group' => 'plan', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete plan', 'group' => 'plan', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit plan', 'group' => 'plan', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # goal
            array('name' => 'view goal', 'group' => 'goal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add goal', 'group' => 'goal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete goal', 'group' => 'goal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit goal', 'group' => 'goal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # plan configuration
            array('name' => 'long term', 'group' => 'plan configuration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'middle term', 'group' => 'plan configuration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'short term', 'group' => 'plan configuration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'regional plan', 'group' => 'plan configuration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'international plan', 'group' => 'plan configuration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # priority area
            array('name' => 'view priority area', 'group' => 'priority area', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add priority area', 'group' => 'priority area', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete priority area', 'group' => 'priority area', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit priority area', 'group' => 'priority area', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # aspiration
            array('name' => 'view aspiration', 'group' => 'aspiration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add aspiration', 'group' => 'aspiration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete aspiration', 'group' => 'aspiration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit aspiration', 'group' => 'aspiration', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # kpi
            array('name' => 'view kpi', 'group' => 'kpi', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add kpi', 'group' => 'kpi', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete kpi', 'group' => 'kpi', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit kpi', 'group' => 'kpi', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # baseline
            array('name' => 'view baseline', 'group' => 'baseline', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add baseline', 'group' => 'baseline', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete baseline', 'group' => 'baseline', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit baseline', 'group' => 'baseline', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # target
            array('name' => 'view target', 'group' => 'target', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add target', 'group' => 'target', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete target', 'group' => 'target', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit target', 'group' => 'target', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # strategic area
            array('name' => 'view strategic area', 'group' => 'strategic area', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add strategic area', 'group' => 'strategic area', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete strategic area', 'group' => 'strategic area', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit strategic area', 'group' => 'strategic area', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # strategic intervention
            array('name' => 'view strategic intervention', 'group' => 'strategic intervention', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add strategic intervention', 'group' => 'strategic intervention', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete strategic intervention', 'group' => 'strategic intervention', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit strategic intervention', 'group' => 'strategic intervention', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # ministry
            array('name' => 'view ministry', 'group' => 'ministry', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add ministry', 'group' => 'ministry', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete ministry', 'group' => 'ministry', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit ministry', 'group' => 'ministry', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # institution
            array('name' => 'view institution', 'group' => 'institution', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add institution', 'group' => 'institution', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete institution', 'group' => 'institution', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit institution', 'group' => 'institution', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # department
            array('name' => 'view department', 'group' => 'department', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add department', 'group' => 'department', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete department', 'group' => 'department', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit department', 'group' => 'department', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # rd committee
            array('name' => 'view rd committee', 'group' => 'rd committee', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add rd committee', 'group' => 'rd committee', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete rd committee', 'group' => 'rd committee', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit rd committee', 'group' => 'rd committee', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # municipal council
            array('name' => 'view municipal council', 'group' => 'municipal council', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add municipal council', 'group' => 'municipal council', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete municipal council', 'group' => 'municipal council', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit municipal council', 'group' => 'municipal council', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # location
            array('name' => 'view region', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add region', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete region', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit region', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'view district', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add district', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete district', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit district', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'view shehia', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add shehia', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete shehia', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit shehia', 'group' => 'location', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # concept note
            array('name' => 'view concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add  concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit  concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete  concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'screening concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'initiate concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'verify concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'submit concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'receive concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'open concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'approve concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # concept note approval
            array('name' => 'view concept note approval', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'propose  concept note', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'concept note print view', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # request implementation
            array('name' => 'view implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'propose implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'print implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'comment implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'initiate implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'submit implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'receieve implementation request', 'group' => 'concept note', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # screening question
            array('name' => 'view screening question', 'group' => 'screening question', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add screening question', 'group' => 'screening question', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit screening question', 'group' => 'screening question', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete screening question', 'group' => 'screening question', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # appraisal question
            array('name' => 'view appraisal question', 'group' => 'appraisal question', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add appraisal question', 'group' => 'appraisal question', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit appraisal question', 'group' => 'appraisal question', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete appraisal question', 'group' => 'appraisal question', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # source of finance
            array('name' => 'view source of finance', 'group' => 'source of finance', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add source of finance', 'group' => 'source of finance', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit source of finance', 'group' => 'source of finance', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete source of finance', 'group' => 'source of finance', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # zpc calendar
            array('name' => 'view zpc calendar', 'group' => 'zpc calendar', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add zpc calendar', 'group' => 'zpc calendar', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit zpc calendar', 'group' => 'zpc calendar', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete zpc calendar', 'group' => 'zpc calendar', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # budget form
            array('name' => 'view budget form', 'group' => 'budget form', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add budget form', 'group' => 'budget form', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit budget form', 'group' => 'budget form', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete budget form', 'group' => 'budget form', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # unit value
            array('name' => 'view unit value', 'group' => 'unit value', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add unit value', 'group' => 'unit value', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit unit value', 'group' => 'unit value', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete unit value', 'group' => 'unit value', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # financial particular
            array('name' => 'view financial particular', 'group' => 'financial particular', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add financial particular', 'group' => 'financial particular', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit financial particular', 'group' => 'financial particular', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete financial particular', 'group' => 'financial particular', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # view sector
            array('name' => 'view sector', 'group' => 'sector', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add sector', 'group' => '', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit sector', 'group' => 'sector', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete sector', 'group' => 'sector', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # project proposal
            array('name' => 'view project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'initiate project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'verify project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'submit project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'receive project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'approve  project proposal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # view project appraisal
            array('name' => 'view  project proposal appraisal', 'group' => 'project proposal', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # project monitoring
            array('name' => 'view project monitoring', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'comment project monitoring', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'view monitoring', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add monitoring', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit monitoring', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete monitoring', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'view implementation checking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add implementation checking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit implementation checking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete implementation checking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'view resource', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add resource', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit implementation report', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'print resource', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete implementation report', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit activity report', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete activity report', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'finish resource tracking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'verify resource tracking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'submit resource tracking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'receive resource tracking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'open resource tracking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'approved resource tracking', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # project financial
            array('name' => 'view project financial', 'group' => 'project financial', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add project financial', 'group' => 'project financial', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit project financial', 'group' => 'project financial', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete project financial', 'group' => 'project financial', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # development partner
            array('name' => 'view development partner', 'group' => 'development partner', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add development partner', 'group' => 'development partner', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit development partner', 'group' => 'development partner', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete development partner', 'group' => 'development partner', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # financing agreement
            array('name' => 'view financing agreement', 'group' => 'financing agreement', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add financing agreement', 'group' => 'financing agreement', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit financing agreement', 'group' => 'financing agreement', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete financing agreement', 'group' => 'financing agreement', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # disbursing
            array('name' => 'view disbursing', 'group' => 'disbursing', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'add disbursing', 'group' => 'disbursing', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'edit disbursing', 'group' => 'disbursing', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'delete disbursing', 'group' => 'disbursing', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),

            # request implementation
            array('name' => 'request implementation', 'group' => 'request implementation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # project evaluation
            array('name' => 'view project evaluation', 'group' => 'project evaluation', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            # report
            array('name' => 'view program/project report', 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'download program/project report', 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'view stakeholder report', 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'download stakeholder report', 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'view monitoring report', 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'download monitoring report', 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'view financing report', 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => 'download financing report', 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => "view LGA's report", 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),
            array('name' => "download LGA's report", 'group' => 'report', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()),

        );

        DB::table('permissions')->insert($permissions);
    }
}
