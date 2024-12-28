<?php

namespace App\Http\Controllers;

use App\Models\MunicipalCouncil;
use App\Models\MunicipalUser;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MunicipalUserController extends Controller
{
    public function index()
    {
        $users = MunicipalUser::with('region', 'municipal', 'user')->get();
        return response()->json($users);
    }

    public function create()
    {
        $region = Region::all();
        $municipal = MunicipalCouncil::all();

        return response()->json(['region' => $region, 'municipal' => $municipal]);
    }

    public function storeOrUpdate(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id . ',id',
            'region_id' => 'nullable|exists:regions,id',
            'municipal_id' => 'nullable|exists:municipal_councils,id',
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

        ($request->input('id')) ? $user_id = $user->municipalUser->id : $user_id = null;

        # Create or update institution user
        MunicipalUser::updateOrCreate(
            ['id' => $user_id], // Match by id if exists
            [
                'user_id' => $user->id, // Link to the user
                'municipal_id' => $request->municipal_id,
                'region_id' => $request->region_id,
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

        $user = MunicipalUser::find($id);
        if(!$user){
            return response()->json('user not found', 404);
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
        $user = MunicipalUser::with('user')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = MunicipalUser::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        # Delete the user
        $user->delete();

        return response()->json(['message' => 'users deleted successfully']);
    }
}
