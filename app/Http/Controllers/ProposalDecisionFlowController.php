<?php

namespace App\Http\Controllers;

use App\Models\ProposalDecisionFlow;
use Illuminate\Http\Request;

class ProposalDecisionFlowController extends Controller
{
    public function index()
    {
        $proposalDecisionFlows = ProposalDecisionFlow::all();
        return response()->json($proposalDecisionFlows);
    }

    public function show($id)
    {
        $proposalDecisionFlow = ProposalDecisionFlow::find($id);
        if ($proposalDecisionFlow) {
            return response()->json($proposalDecisionFlow);
        } else {
            return response()->json(['message' => 'Proposal Decision Flow not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'proposal_id' => 'required|integer',
            'role_id' => 'required|integer',
            'officer_status' => 'required|string',
            'comment' => 'required|string',
            'action' => 'required|string',
            'decision_status' => 'required|string',
        ]);

        $id = $request->input('id');

        if ($id) {
            $proposalDecisionFlow = ProposalDecisionFlow::find($id);
            if ($proposalDecisionFlow) {
                $proposalDecisionFlow->update($request->all());
                return response()->json(['message' => 'Proposal Decision Flow updated successfully', 'proposalDecisionFlow' => $proposalDecisionFlow]);
            } else {
                return response()->json(['message' => 'Proposal Decision Flow not found'], 404);
            }
        } else {
            $proposalDecisionFlow = ProposalDecisionFlow::create($request->all());
            return response()->json(['message' => 'Proposal Decision Flow created successfully', 'proposalDecisionFlow' => $proposalDecisionFlow], 201);
        }
    }

    public function destroy($id)
    {
        $proposalDecisionFlow = ProposalDecisionFlow::find($id);
        if ($proposalDecisionFlow) {
            $proposalDecisionFlow->delete();
            return response()->json(['message' => 'Proposal Decision Flow deleted successfully']);
        } else {
            return response()->json(['message' => 'Proposal Decision Flow not found'], 404);
        }
    }
}
