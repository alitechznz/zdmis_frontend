<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::with('creator')->get();
        return response()->json($plans);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create or update the plan
        $plan = Plan::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('name', 'code', 'type', 'description', 'start_date', 'end_date')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    public function show($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Plan not found'], 404);
        }

        return response()->json($plan, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $plan = Plan::find($id);
        if(!$plan){
            return response()->json('Plan not found', 404);
        }
        if($plan->status == 'active'){
            $plan->status = 'inactive';
        } else {
            $plan->status = 'active';
        }
        $plan->save();
        return response()->json($plan, 200);
    }

    public function destroy($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Plan not found'], 404);
        }

        $plan->delete();

        return response()->json(['message' => 'Plan deleted successfully']);
    }
}
