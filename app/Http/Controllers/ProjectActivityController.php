<?php

namespace App\Http\Controllers;

use App\Models\ProjectActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProjectActivityController extends Controller
{
    public function index()
    {
        $projectActivities = ProjectActivity::all();
        return response()->json($projectActivities);
    }

    public function show($id)
    {
        $projectActivity = ProjectActivity::find($id);
        return $projectActivity ? response()->json($projectActivity) : response()->json(['message' => 'Project activity not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'projectproposal_id' => 'required|integer',
            'output_id' => 'required|integer',
            'name' => 'required|string',
            'type' => 'required|string',
            'status' => 'required|string',
            'gfscode' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|string',
            'created_by' => 'required|string',
        ]);

        $id = $request->input('id');

        if ($id) {
            $projectActivity = ProjectActivity::find($id);
            if ($projectActivity) {
                $projectActivity->update($request->all());
                return response()->json(['message' => 'Project activity updated successfully', 'projectActivity' => $projectActivity]);
            } else {
                return response()->json(['message' => 'Project activity not found'], 404);
            }
        } else {
            $projectActivity = ProjectActivity::create($request->all());
            return response()->json(['message' => 'Project activity created successfully', 'projectActivity' => $projectActivity], 201);
        }
    }

    public function destroy($id)
    {
        $projectActivity = ProjectActivity::find($id);
        if ($projectActivity) {
            $projectActivity->delete();
            return response()->json(['message' => 'Project activity deleted successfully']);
        } else {
            return response()->json(['message' => 'Project activity not found'], 404);
        }
    }
}
