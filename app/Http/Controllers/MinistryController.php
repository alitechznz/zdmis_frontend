<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MinistryController extends Controller
{
    public function index(){
        $ministries = Ministry::all();
        return response()->json($ministries);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255|unique:ministries,short_name,' . $request->id,
            'awamu' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create or update the record
        $ministry = Ministry::updateOrCreate(
            ['id' => $request->id], // Match by id if it exists
            $request->only('name', 'short_name', 'awamu', 'type', 'phone', 'email', 'address', 'status', 'created_by')
        );

        return response()->json(['message' => 'Ministry created successful'], 200);
    }

    public function show($id)
    {
        $ministry = Ministry::find($id);

        if (!$ministry) {
            return response()->json(['message' => 'Ministry not found'], 404);
        }

        return response()->json($ministry);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $ministry = Ministry::find($id);
        if(!$ministry){
            return response()->json('Ministry not found', 404);
        }
        if($ministry->status == 'active'){
            $ministry->status = 'inactive';
        } else {
            $ministry->status = 'active';
        }
        $ministry->save();
        return response()->json($ministry, 200);
    }

    public function destroy($id)
    {
        $ministry = Ministry::find($id);

        if (!$ministry) {
            return response()->json(['message' => 'Ministry not found'], 404);
        }

        $ministry->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
