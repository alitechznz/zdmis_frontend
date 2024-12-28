<?php

namespace App\Http\Controllers;

use App\Models\ConceptNoteOutcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ConceptNoteOutcomeController extends Controller
{
    public function index()
    {
        $outcomes = ConceptNoteOutcome::all();
        return response()->json($outcomes);
    }

    public function show($id)
    {
        $outcome = ConceptNoteOutcome::find($id);
        if ($outcome) {
            return response()->json($outcome);
        } else {
            return response()->json(['message' => 'Concept Note Outcome not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conceptnote_id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toJson()], 422);
        }

       ConceptNoteOutcome::updateOrCreate(
            ['id' => $request->input('id')],
            $validator->validated()
        );

        return response()->json(['message' => 'Concept Note OutCome saved successfully.'], 200);
    }

       
    public function destroy($id)
    {
        $outcome = ConceptNoteOutcome::find($id);
        if ($outcome) {
            $outcome->delete();
            return response()->json(['message' => 'Concept Note Outcome deleted successfully']);
        } else {
            return response()->json(['message' => 'Concept Note Outcome not found'], 404);
        }
    }
}
