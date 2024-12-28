<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Pillar;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PillarController extends Controller
{
    public function index()
    {
        $pillars = Pillar::with('creator', 'plan')->get();
        return response()->json($pillars);
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

        // Create or update the pillar
        $pillar = Pillar::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('plan_id', 'name', 'description')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    public function show($id)
    {
        $pillar = Pillar::with('plan')->find($id);

        if (!$pillar) {
            return response()->json(['message' => 'Pillar not found'], 404);
        }

        return response()->json($pillar, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $pillar = Pillar::find($id);
        if(!$pillar){
            return response()->json('Pillar not found', 404);
        }
        if($pillar->status == 'active'){
            $pillar->status = 'inactive';
        } else {
            $pillar->status = 'active';
        }
        $pillar->save();
        return response()->json($pillar, 200);
    }

    public function destroy($id)
    {
        $pillar = Pillar::find($id);

        if (!$pillar) {
            return response()->json(['message' => 'Pillar not found'], 404);
        }

        $pillar->delete();

        return response()->json(['message' => 'Pillar deleted successfully']);
    }
}
