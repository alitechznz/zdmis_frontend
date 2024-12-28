<?php

namespace App\Http\Controllers;

use App\Models\ActivityPlanFinance;
use Illuminate\Http\Request;

class ActivityPlanFinanceController extends Controller
{
    public function index()
    {
        $activityPlanFinances = ActivityPlanFinance::all();
        return response()->json($activityPlanFinances);
    }

    public function show($id)
    {
        $activityPlanFinance = ActivityPlanFinance::find($id);
        return $activityPlanFinance ? response()->json($activityPlanFinance) : response()->json(['message' => 'Finance record not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'projectactivity_id' => 'required|integer',
            'amount' => 'required|integer',
            'currency' => 'required|string',
            'status' => 'required|string',
            'sponser_id' => 'required|integer',
            'created_by' => 'required|string',
        ]);

        $id = $request->input('id');

        if ($id) {
            $activityPlanFinance = ActivityPlanFinance::find($id);
            if ($activityPlanFinance) {
                $activityPlanFinance->update($request->all());
                return response()->json(['message' => 'Finance record updated successfully', 'activityPlanFinance' => $activityPlanFinance]);
            } else {
                return response()->json(['message' => 'Finance record not found'], 404);
            }
        } else {
            $activityPlanFinance = ActivityPlanFinance::create($request->all());
            return response()->json(['message' => 'Finance record created successfully', 'activityPlanFinance' => $activityPlanFinance], 201);
        }
    }

    public function destroy($id)
    {
        $activityPlanFinance = ActivityPlanFinance::find($id);
        if ($activityPlanFinance) {
            $activityPlanFinance->delete();
            return response()->json(['message' => 'Finance record deleted successfully']);
        } else {
            return response()->json(['message' => 'Finance record not found'], 404);
        }
    }
}
