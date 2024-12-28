<?php

namespace App\Http\Controllers;

use App\Models\DecisionFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class DecisionFlowController extends Controller
{
    public function index()
    {
        $decisionFlows = DecisionFlow::all();
        return response()->json($decisionFlows);
    }

    public function show($id)
    {
        $decisionFlow = DecisionFlow::find($id);
        if ($decisionFlow) {
            return response()->json($decisionFlow);
        } else {
            return response()->json(['message' => 'Decision flow not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'conceptnote_id' => 'required|integer',
            'status' => 'required|string',
            'comment' => 'required|string',
            'action' => 'required|string',
            'role_id' => 'required|integer',
        ]);

        $id = $request->input('id');

        if ($id) {
            $decisionFlow = DecisionFlow::find($id);
            if ($decisionFlow) {
                $decisionFlow->update($request->all());
                return response()->json(['message' => 'Decision flow updated successfully', 'decisionFlow' => $decisionFlow]);
            } else {
                return response()->json(['message' => 'Decision flow not found'], 404);
            }
        } else {
            $decisionFlow = DecisionFlow::create($request->all());
            return response()->json(['message' => 'Decision flow created successfully', 'decisionFlow' => $decisionFlow], 201);
        }
    }

    public function destroy($id)
    {
        $decisionFlow = DecisionFlow::find($id);
        if ($decisionFlow) {
            $decisionFlow->delete();
            return response()->json(['message' => 'Decision flow deleted successfully']);
        } else {
            return response()->json(['message' => 'Decision flow not found'], 404);
        }
    }
}
