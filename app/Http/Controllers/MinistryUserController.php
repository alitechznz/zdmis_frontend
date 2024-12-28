<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use App\Models\User;
use App\Models\MinistryUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MinistryUserController extends Controller
{
    public function index()
    {
        $users = MinistryUser::with('user')->get();
        return response()->json($users);
    }

    public function create()
    {
        $ministries = Ministry::all();
        return response()->json($ministries);
    }

    public function storeOrUpdate(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'. $request->id . ',id',
            'full_name' => 'required|string|max:120',
            'phone' => 'required|string|max:15',
            'ministry_id' => 'nullable|exists:ministries,id',
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

        ($request->input('id')) ? $ministry_id = $user->ministryUser->id : $ministry_id = null;
        # Create or update the ministry user
        MinistryUser::updateOrCreate(['id' => $ministry_id ?? null], // Match by id if exists
            [
                'user_id' => $user->id, // Link to the user
                'ministry_id' => $request->ministry_id,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'employmentID' => $request->employmentID,
                'address' => $request->address,
            ]
        );

        return response()->json(['message' => 'Successful'], 200);
    }

    public function show($id)
    {
        $user = MinistryUser::with('user')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = MinistryUser::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        # Delete the user
        $user->delete();

        return response()->json(['message' => 'users deleted successfully']);
    }
}
