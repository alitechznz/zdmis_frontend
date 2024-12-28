<?php

namespace App\Http\Controllers;

use App\Models\ProjectQuestion;
use Illuminate\Http\Request;

class ProjectQuestionController extends Controller
{
    public function index()
    {
        $projectQuestions = ProjectQuestion::all();
        return response()->json($projectQuestions);
    }

    public function show($id)
    {
        $projectQuestion = ProjectQuestion::find($id);
        return $projectQuestion ? response()->json($projectQuestion) : response()->json(['message' => 'Project Question not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'page' => 'required|string',
            'section' => 'required|string',
            'number' => 'required|string',
            'result' => 'required|string',
            'section_number' => 'required|string',
        ]);
    
        $userId = auth()->id();
    
        $id = $request->input('id');
    
        if ($id) {
            $projectQuestion = ProjectQuestion::find($id);
            if ($projectQuestion) {
                $projectQuestion->update(array_merge($request->all(), ['created_by' => $userId]));
                return response()->json(['message' => 'Project Question updated successfully', 'projectQuestion' => $projectQuestion]);
            } else {
                return response()->json(['message' => 'Project Question not found'], 404);
            }
        } else {
            $projectQuestion = ProjectQuestion::create(array_merge($request->all(), ['created_by' => $userId]));
            return response()->json(['message' => 'Project Question created successfully', 'projectQuestion' => $projectQuestion], 201);
        }
    }
    

    public function destroy($id)
    {
        $projectQuestion = ProjectQuestion::find($id);
        if ($projectQuestion) {
            $projectQuestion->delete();
            return response()->json(['message' => 'Project Question deleted successfully']);
        } else {
            return response()->json(['message' => 'Project Question not found'], 404);
        }
    }
}
