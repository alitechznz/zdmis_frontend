<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::with('creator', 'plan')->get();
        return response()->json($goals);
    }

    public function create()
    {
        $plans = Plan::all();

        return response()->json($plans);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create or update the goal
        $goal = Goal::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('plan_id', 'name', 'description')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    public function show($id)
    {
        $goal = Goal::with('plan')->find($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $goal = Goal::find($id);
        if(!$goal){
            return response()->json('Goal not found', 404);
        }
        if($goal->status == 'active'){
            $goal->status = 'inactive';
        } else {
            $goal->status = 'active';
        }
        $goal->save();
        return response()->json($goal, 200);
    }

    public function destroy($id)
    {
        $goal = Goal::find($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        $goal->delete();

        return response()->json(['message' => 'Goal deleted successfully']);
    }
}
