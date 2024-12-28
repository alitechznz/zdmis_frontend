<?php
namespace App\Http\Controllers;

use App\Models\ConceptNoteOutput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConceptNoteOutputController extends Controller
{
    public function index()
    {
        $outputs = ConceptNoteOutput::with(['conceptNote', 'outcome'])->get();
        return response()->json($outputs, 200);
    }

    public function show($id)
    {
        $output = ConceptNoteOutput::with(['conceptNote', 'outcome'])->find($id);
        if ($output) {
            return response()->json($output, 200);
        } else {
            return response()->json(['message' => 'Concept Note Output not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'conceptnote_id' => 'required|exists:concept_notes,id',
            'outcome_id' => 'required|exists:concept_note_outcomes,id',
            'name' => 'required|string',
            'output_type' => 'required|string',
        ]);

     
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toJson()], 422);
        }

       
        ConceptNoteOutput::updateOrCreate(
            ['id' => $request->input('id')],
            $validator->validated()
        );

        return response()->json(['message' => 'Concept Note Output saved successfully.'], 200);
    }

    public function destroy($id)
    {
        $output = ConceptNoteOutput::find($id);
        if (!$output) {
            return response()->json(['message' => 'Concept Note Output not found'], 404);
        }

        $output->delete();
        return response()->json(['message' => 'Concept Note Output deleted successfully'], 200);
    }
}
