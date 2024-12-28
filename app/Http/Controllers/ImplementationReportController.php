<?php

namespace App\Http\Controllers;

use App\Models\ConceptNote;
use App\Models\ImplementationReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImplementationReportController extends Controller
{
    public function index()
    {
        $reports = ImplementationReport::all();
        return response()->json($reports);
    }

    public function getProjectCode($projectId)
    {
        $project = ConceptNote::find($projectId);
        return response()->json(['project_code' => $project ? $project->project_code : null]);
    }

    public function show($id)
    {
        $report = ImplementationReport::find($id);
        if ($report) {
            return response()->json($report);
        } else {
            return response()->json(['message' => 'Implementation Report not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projectactivity_id' => 'required|integer',
            'indicator_id' => 'required|integer',
            'baseline_id' => 'required|integer',
            'result_value' => 'required|string',
            'result_value_percentage' => 'required|string',
            'remark' => 'required|string',
            'status' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $id = $request->input('id');
        $createdBy = auth()->id();

        if ($id) {
            $report = ImplementationReport::find($id);
            if (!$report) {
                return response()->json(['message' => 'Implementation Report not found'], 404);
            }

            $report->update(array_merge($validator->validated(), ['createdby' => $createdBy]));

            return response()->json(['message' => 'Implementation Report updated successfully', 'data' => $report], 200);
        } else {
            $report = ImplementationReport::create(array_merge($validator->validated(), ['createdby' => $createdBy]));

            return response()->json(['message' => 'Implementation Report created successfully', 'data' => $report], 201);
        }
    }

    public function destroy($id)
    {
        $report = ImplementationReport::find($id);
        if ($report) {
            $report->delete();
            return response()->json(['message' => 'Implementation Report deleted successfully']);
        } else {
            return response()->json(['message' => 'Implementation Report not found'], 404);
        }
    }
}
