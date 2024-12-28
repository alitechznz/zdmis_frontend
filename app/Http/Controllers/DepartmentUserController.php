<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\Institution;
use App\Models\Ministry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DepartmentUserController extends Controller
{
    public function index()
    {
        $users = DepartmentUser::with('user')->get();
        return response()->json($users);
    }

    public function create()
    {
        $institution = Institution::all();
        $department = Department::all();

        return response()->json(['institution' => $institution, 'department' => $department]);
    }

    public function storeOrUpdate(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id . ',id',
            'institution_id' => 'nullable|exists:institutions,id',
            'department_id' => 'nullable|exists:departments,id',
            'full_name' => 'required|string|max:120',
            'phone' => 'required|string|max:15',
            'employmentID' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
        ];

        if (!$request->filled('id')) {
            $rules['password'] = 'required|string|min:6';
        } else {
            $_user = User::find($request->id);
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        # Create or update the user first
        $user = User::updateOrCreate(['id' => $request->id],[
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status ?? 'active',
                'password' => ($request->filled('password')) ? Hash::make($request->password) : $_user->password,
            ]
        );

        ($request->input('id')) ? $user_id = $user->departmentUser->id : $user_id = null;

        # Create or update institution user
        DepartmentUser::updateOrCreate(
            ['id' => $user_id], // Match by id if exists
            [
                'user_id' => $user->id, // Link to the user
                'institution_id' => $request->institution_id,
                'department_id' => $request->department_id,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'employmentID' => $request->employmentID,
                'address' => $request->address,
            ]
        );

        return response()->json(['message' => 'Successful'], 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $user = DepartmentUser::find($id);
        if(!$user){
            return response()->json('Department user not found', 404);
        }
        if($user->status == 'active'){
            $user->status = 'inactive';
        } else {
            $user->status = 'active';
        }
        $user->save();
        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = DepartmentUser::with('user')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = DepartmentUser::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        # Delete the user
        $user->delete();

        return response()->json(['message' => 'users deleted successfully']);
    }
}
