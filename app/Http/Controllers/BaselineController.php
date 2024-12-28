<?php

namespace App\Http\Controllers;

use App\Models\Baseline;
use App\Models\KPI;
use App\Models\Ministry;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaselineController extends Controller
{
    // Get all baselines
    public function index()
    {
        $baselines = Baseline::with('creator', 'kpi', 'unit')->get();
        return response()->json($baselines);
    }

    public function create(){
        $user = auth()->user();
        # $units = $ministry->getAllUnits();
        $units = Unit::all();
        $kpi = Kpi::all();

        return response()->json(['units' => $units, 'kpi' => $kpi], 200);
    }

    // Create or update a baseline
    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kpi_id' => 'required|exists:kpi,id',
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $baseline = Baseline::updateOrCreate(['id' => $request->id],
            $request->only( 'kpi_id', 'unit_id', 'name', 'value', 'year')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    // Show a specific baseline
    public function show($id)
    {
        $baseline = Baseline::with('kpi', 'unit')->find($id);

        if (!$baseline) {
            return response()->json(['message' => 'Baseline not found'], 404);
        }

        return response()->json($baseline, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $baseline = Baseline::find($id);
        if(!$baseline){
            return response()->json('Baseline not found', 404);
        }
        if($baseline->status == 'active'){
            $baseline->status = 'inactive';
        } else {
            $baseline->status = 'active';
        }
        $baseline->save();
        return response()->json($baseline, 200);
    }

    // Delete a baseline
    public function destroy($id)
    {
        $baseline = Baseline::find($id);

        if (!$baseline) {
            return response()->json(['message' => 'Baseline not found'], 404);
        }

        $baseline->delete();

        return response()->json(['message' => 'Baseline deleted successfully']);
    }
}

