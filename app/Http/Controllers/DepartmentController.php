<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('institution')->get();
        return response()->json($departments);
    }

    public function create()
    {
        $institutions = Institution::all();

        return response()->json($institutions);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'institution_id' => 'required|exists:institutions,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create or update the department
        $department = Department::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('institution_id', 'name', 'address')
        );

        return response()->json(['message' => 'Department created successful'], 200);
    }

    public function show($id)
    {
        $department = Department::with('institution')->find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        return response()->json($department);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $department = Department::find($id);
        if(!$department){
            return response()->json('Department not found', 404);
        }
        if($department->status == 'active'){
            $department->status = 'inactive';
        } else {
            $department->status = 'active';
        }
        $department->save();
        return response()->json($department, 200);
    }

    public function destroy($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        $department->delete();

        return response()->json(['message' => 'Department deleted successfully']);
    }
}
