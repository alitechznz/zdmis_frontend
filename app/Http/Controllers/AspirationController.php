<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\PriorityArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AspirationController extends Controller
{
    // Get all aspirations
    public function index()
    {
        $aspirations = Aspiration::with('priorityArea')->get();
        return response()->json($aspirations);
    }

    public function create()
    {
        $priority_areas = PriorityArea::all();
        return response()->json($priority_areas);
    }

    // Create or update an aspiration
    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'priority_area_id' => 'required|exists:priority_areas,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $aspiration = Aspiration::updateOrCreate(['id' => $request->id],
            $request->only( 'priority_area_id', 'name')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    // Show a specific aspiration
    public function show($id)
    {
        $aspiration = Aspiration::with('priorityArea')->find($id);

        if (!$aspiration) {
            return response()->json(['message' => 'Aspiration not found'], 404);
        }

        return response()->json($aspiration, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $aspiration = Aspiration::find($id);
        if(!$aspiration){
            return response()->json('Aspiration not found', 404);
        }
        if($aspiration->status == 'active'){
            $aspiration->status = 'inactive';
        } else {
            $aspiration->status = 'active';
        }
        $aspiration->save();
        return response()->json($aspiration, 200);
    }

    // Delete an aspiration
    public function destroy($id)
    {
        $aspiration = Aspiration::find($id);

        if (!$aspiration) {
            return response()->json(['message' => 'Aspiration not found'], 404);
        }

        $aspiration->delete();

        return response()->json(['message' => 'Aspiration deleted successfully']);
    }
}

