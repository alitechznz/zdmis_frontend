<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleAndPermissionController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return response()->json($role);
    }

    public function storeOrUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255||unique:roles,name',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }
        Role::updateOrCreate(['id' => $request->id], $request->only('name'));

        return response()->json(['message' => 'Role created successful'], 200);
    }

    public function getPermissions(Role $role)
    {
        return response()->json([
            'role' => $role,
            'groups' => Permission::distinct()->get("group"),
            'permissions' => Permission::all(),
        ], 200);
    }

    public function storePermission(Request $request, Role $role){
        $role->syncPermissions($request->input('permissions'));

        return response()->json(['message', 'Permission synced successful'], 200);
    }

    public function destroy($id){
        $role = Role::findById($id);

        if (!$role) {
            return response()->json('Role not found', 404);
        }

        $role->delete();
        return response()->json('Role deleted successfully', 200);
    }
}
