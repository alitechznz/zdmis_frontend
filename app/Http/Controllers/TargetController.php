<?php

namespace App\Http\Controllers;

use App\Models\Baseline;
use App\Models\Target;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TargetController extends Controller
{
    // Get all targets
    public function index()
    {
        $targets = Target::with('baseline', 'unit')->get();
        return response()->json($targets);
    }

    public function create()
    {
        $unit = Unit::all();
        $baseline = Baseline::all();

        return response()->json(['unit' => $unit, 'baseline' => $baseline], 200);
    }

    // Create or update a target
    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'baseline_id' => 'required|exists:baselines,id',
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $target = Target::updateOrCreate(['id' => $request->id],
            $request->only( 'baseline_id', 'unit_id', 'name', 'value', 'year')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    // Show a specific target
    public function show($id)
    {
        $target = Target::with('baseline', 'unit')->find($id);

        if (!$target) {
            return response()->json(['message' => 'Target not found'], 404);
        }

        return response()->json($target, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $target = Target::find($id);
        if(!$target){
            return response()->json('Target not found', 404);
        }
        if($target->status == 'active'){
            $target->status = 'inactive';
        } else {
            $target->status = 'active';
        }
        $target->save();
        return response()->json($target, 200);
    }

    // Delete a target
    public function destroy($id)
    {
        $target = Target::find($id);

        if (!$target) {
            return response()->json(['message' => 'Target not found'], 404);
        }

        $target->delete();

        return response()->json(['message' => 'Target deleted successfully']);
    }
}

