<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use App\Models\PriorityArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriorityAreaController extends Controller
{
    public function index()
    {
        $priorityAreas = PriorityArea::with('creator', 'pillar')->get();
        return response()->json($priorityAreas);
    }

    public function create(){
        $pillar = Pillar::all();
        return response()->json($pillar);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pillar_id' => 'required|exists:pillars,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create or update the priority area
        $priorityArea = PriorityArea::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('pillar_id', 'name', 'description')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    public function show($id)
    {
        $priorityArea = PriorityArea::with('pillar')->find($id);

        if (!$priorityArea) {
            return response()->json(['message' => 'Priority Area not found'], 404);
        }

        return response()->json($priorityArea, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $priorityArea = PriorityArea::find($id);
        if(!$priorityArea){
            return response()->json('Priority area not found', 404);
        }
        if($priorityArea->status == 'active'){
            $priorityArea->status = 'inactive';
        } else {
            $priorityArea->status = 'active';
        }
        $priorityArea->save();
        return response()->json($priorityArea, 200);
    }

    public function destroy($id)
    {
        $priorityArea = PriorityArea::find($id);

        if (!$priorityArea) {
            return response()->json(['message' => 'Priority Area not found'], 404);
        }

        $priorityArea->delete();

        return response()->json(['message' => 'Priority Area deleted successfully']);
    }
}
