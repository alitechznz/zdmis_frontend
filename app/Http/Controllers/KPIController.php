<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\KPI;
use App\Models\PriorityArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KPIController extends Controller
{
    // Get all KPIs
    public function index()
    {
        $kpis = KPI::with('goal', 'priorityArea')->get();
        return response()->json($kpis);
    }

    public function create(){
        $goals = Goal::all();
        $priority_areas = PriorityArea::all();

        return response()->json(['goals' => $goals, 'priority_areas' => $priority_areas]);
    }

    // Create or update a KPI
    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goal_id' => 'required|exists:goals,id',
            'priority_area_id' => 'required|exists:priority_areas,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kpi = KPI::updateOrCreate(['id' => $request->id],
            $request->only( 'goal_id', 'priority_area_id', 'name', 'type')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    // Show a specific KPI
    public function show($id)
    {
        $kpi = KPI::with('goal', 'priorityArea')->find($id);

        if (!$kpi) {
            return response()->json(['message' => 'KPI not found'], 404);
        }

        return response()->json($kpi, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $kpi = KPI::find($id);
        if(!$kpi){
            return response()->json('KPI not found', 404);
        }
        if($kpi->status == 'active'){
            $kpi->status = 'inactive';
        } else {
            $kpi->status = 'active';
        }
        $kpi->save();
        return response()->json($kpi, 200);
    }

    // Delete a KPI
    public function destroy($id)
    {
        $kpi = KPI::find($id);

        if (!$kpi) {
            return response()->json(['message' => 'KPI not found'], 404);
        }

        $kpi->delete();

        return response()->json(['message' => 'KPI deleted successfully']);
    }
}
