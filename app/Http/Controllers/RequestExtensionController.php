<?php

namespace App\Http\Controllers;

use App\Models\ConceptNote;
use Illuminate\Http\Request;

class RequestExtensionController extends Controller
{
    public function getProjectCode($id)
    {
        // Assuming you want to ensure the project is of type 'proposal' and has a process_status of 6
        $project = ConceptNote::where('id', $id)
            ->where('type', 'proposal')
            ->where('process_status', 6)
            ->first();

        if ($project) {
            return response()->json([
                'project_code' => $project->project_code
            ]);
        } else {
            return response()->json([
                'project_code' => null
            ], 404); // Optionally return a 404 if no project matches the criteria
        }
    }
}
