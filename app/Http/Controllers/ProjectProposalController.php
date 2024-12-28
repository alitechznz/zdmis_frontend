<?php

namespace App\Http\Controllers;

use App\Models\ProjectProposal;
use Illuminate\Http\Request;

class ProjectProposalController extends Controller
{
    public function index()
    {
        $projectProposals = ProjectProposal::all();
        return response()->json($projectProposals);
    }

    public function show($id)
    {
        $projectProposal = ProjectProposal::find($id);
        return $projectProposal ? response()->json($projectProposal) : response()->json(['message' => 'Project proposal not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'conceptnote_id' => 'required|integer',
            'sector' => 'required|string',
            'type' => 'required|string',
            'question_number' => 'required|string',
            'status' => 'required|string',
            'section_number' => 'required|string',
            'created_by' => 'required|string',
        ]);

        $id = $request->input('id');

        if ($id) {
            $projectProposal = ProjectProposal::find($id);
            if ($projectProposal) {
                $projectProposal->update($request->all());
                return response()->json(['message' => 'Project proposal updated successfully', 'projectProposal' => $projectProposal]);
            } else {
                return response()->json(['message' => 'Project proposal not found'], 404);
            }
        } else {
            $projectProposal = ProjectProposal::create($request->all());
            return response()->json(['message' => 'Project proposal created successfully', 'projectProposal' => $projectProposal], 201);
        }
    }

    public function destroy($id)
    {
        $projectProposal = ProjectProposal::find($id);
        if ($projectProposal) {
            $projectProposal->delete();
            return response()->json(['message' => 'Project proposal deleted successfully']);
        } else {
            return response()->json(['message' => 'Project proposal not found'], 404);
        }
    }
}
