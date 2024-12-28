<?php

namespace App\Http\Controllers;

use App\Models\OverrallResult;
use Illuminate\Http\Request;

class OverallResultController extends Controller
{
    public function index()
    {
        $overallResults = OverrallResult::all();
        return response()->json($overallResults);
    }

    public function show($id)
    {
        $overallResult = OverrallResult::find($id);
        return $overallResult ? response()->json($overallResult) : response()->json(['message' => 'Overall result not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'screening_id' => 'required|integer',
            'result' => 'required|string',
            'comment' => 'required|string',
            'created_by' => 'required|string',
            'status' => 'required|string',
            'condition' => 'string|nullable',
        ]);

        $id = $request->input('id');

        if ($id) {
            $overallResult = OverrallResult::find($id);
            if ($overallResult) {
                $overallResult->update($request->all());
                return response()->json(['message' => 'Overall result updated successfully', 'overallResult' => $overallResult]);
            } else {
                return response()->json(['message' => 'Overall result not found'], 404);
            }
        } else {
            $overallResult = OverrallResult::create($request->all());
            return response()->json(['message' => 'Overall result created successfully', 'overallResult' => $overallResult], 201);
        }
    }

    public function destroy($id)
    {
        $overallResult = OverrallResult::find($id);
        if ($overallResult) {
            $overallResult->delete();
            return response()->json(['message' => 'Overall result deleted successfully']);
        } else {
            return response()->json(['message' => 'Overall result not found'], 404);
        }
    }
}
