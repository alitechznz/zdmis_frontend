<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Ministry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstitutionController extends Controller
{
    public function index()
    {
        $institutions = Institution::with('ministry')->get();
        return response()->json($institutions);
    }

    public function create()
    {
        $ministries = Ministry::all();

        return response()->json($ministries);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ministry_id' => 'required|exists:ministries,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $institution = Institution::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('ministry_id', 'name', 'address', 'status')
        );

        return response()->json(['message' => 'Institution created successful'], 200);
    }

    public function show($id)
    {
        $institution = Institution::with('ministry')->find($id);

        if (!$institution) {
            return response()->json(['message' => 'Institution not found'], 404);
        }

        return response()->json($institution);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $institution = Institution::find($id);
        if(!$institution){
            return response()->json('Institution not found', 404);
        }
        if($institution->status == 'active'){
            $institution->status = 'inactive';
        } else {
            $institution->status = 'active';
        }
        $institution->save();
        return response()->json($institution, 200);
    }

    public function destroy($id)
    {
        $institution = Institution::find($id);

        if (!$institution) {
            return response()->json(['message' => 'Institution not found'], 404);
        }

        $institution->delete();

        return response()->json(['message' => 'Institution deleted successfully']);
    }
}
