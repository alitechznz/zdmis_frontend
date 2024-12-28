<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('department', 'creator')->get();
        return response()->json($units);
    }

    public function create()
    {
        $departments = Department::all();

        return response()->json($departments);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $unit = Unit::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('department_id', 'name', 'code', 'address', 'status')
        );

        return response()->json(['message' => 'Unit created successful'], 200);
    }

    public function show($id)
    {
        $unit = Unit::with('department')->find($id);

        if (!$unit) {
            return response()->json(['message' => 'Unit not found'], 404);
        }

        return response()->json($unit, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $unit = Unit::find($id);
        if(!$unit){
            return response()->json('Unit not found', 404);
        }
        if($unit->status == 'active'){
            $unit->status = 'inactive';
        } else {
            $unit->status = 'active';
        }
        $unit->save();
        return response()->json($unit, 200);
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json(['message' => 'Unit not found'], 404);
        }

        $unit->delete();

        return response()->json(['message' => 'Unit deleted successfully']);
    }
}
