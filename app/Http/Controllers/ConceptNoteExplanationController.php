<?php
namespace App\Http\Controllers;

use App\Models\ConceptNoteExplanation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConceptNoteExplanationController extends Controller
{
    public function index()
    {
        $explanations = ConceptNoteExplanation::with('conceptNote')->get();
        return response()->json($explanations, 200);
    }

    public function show($id)
    {
        $explanation = ConceptNoteExplanation::with('conceptNote')->find($id);
        if ($explanation) {
            return response()->json($explanation, 200);
        } else {
            return response()->json(['message' => 'Concept Note Explanation not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'concept_note_id' => 'required|exists:concept_notes,id',
            'background' => 'required|string',
            'justification' => 'required|string',
            'objective' => 'required|string',
            'outcome' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toJson()], 422);
        }

        ConceptNoteExplanation::updateOrCreate(
            ['id' => $request->input('id')],
            $validator->validated()
        );

        return response()->json(['message' => 'Concept Note Explanation saved successfully.'], 200);
    }

    public function destroy($id)
    {
        $explanation = ConceptNoteExplanation::find($id);
        if (!$explanation) {
            return response()->json(['message' => 'Concept Note Explanation not found'], 404);
        }

        $explanation->delete();
        return response()->json(['message' => 'Concept Note Explanation deleted successfully'], 200);
    }
}
