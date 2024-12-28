<?php

namespace App\Http\Controllers;

use App\Models\ProjectProposalActivity;
use App\Models\ProjectProposalOutput;
use Illuminate\Http\Request;

class RequestImplementationController extends Controller
{
    public function getOutputsByOutcome($id)
    {
        $outputs = ProjectProposalOutput::where('project_proposal_outcome_id', $id)->get();
        return response()->json($outputs);
    }

//    public function getActivitiesByOutput($id)
//    {
//        $activities = ProjectProposalActivity::where('project_proposal_output_id', $id)->get();
//        return response()->json($activities);
//    }

    public function getActivitiesByOutput($id)
    {
        $activities = ProjectProposalActivity::where('project_proposal_output_id', $id)
            ->get(['id', 'activity_name', 'planning_amount']);
        return response()->json($activities);
    }


}
