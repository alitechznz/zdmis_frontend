<?php

namespace App\Http\Controllers;

use App\Models\RiskAssumption;
use Illuminate\Http\Request;

class RiskAssumptionController extends Controller
{
    public function index()
    {
        $riskAssumptions = RiskAssumption::all();
        return response()->json($riskAssumptions);
    }

    public function show($id)
    {
        $riskAssumption = RiskAssumption::find($id);
        return $riskAssumption ? response()->json($riskAssumption) : response()->json(['message' => 'Risk assumption not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'projectproposal_id' => 'required|integer',
            'name' => 'required|string',
            'type' => 'required|string',
            'details' => 'required|string',
            'status' => 'required|string',
            'created_by' => 'required|string',
        ]);

        $id = $request->input('id');

        if ($id) {
            $riskAssumption = RiskAssumption::find($id);
            if ($riskAssumption) {
                $riskAssumption->update($request->all());
                return response()->json(['message' => 'Risk assumption updated successfully', 'riskAssumption' => $riskAssumption]);
            } else {
                return response()->json(['message' => 'Risk assumption not found'], 404);
            }
        } else {
            $riskAssumption = RiskAssumption::create($request->all());
            return response()->json(['message' => 'Risk assumption created successfully', 'riskAssumption' => $riskAssumption], 201);
        }
    }

    public function destroy($id)
    {
        $riskAssumption = RiskAssumption::find($id);
        if ($riskAssumption) {
            $riskAssumption->delete();
            return response()->json(['message' => 'Risk assumption deleted successfully']);
        } else {
            return response()->json(['message' => 'Risk assumption not found'], 404);
        }
    }
}
