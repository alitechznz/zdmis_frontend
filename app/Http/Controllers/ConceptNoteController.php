<?php

namespace App\Http\Controllers;

use App\Models\ConceptNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConceptNoteController extends Controller
{
    public function index()
    { 
        $conceptNotes = ConceptNote::with(['user', 'sector', 'plans'])->get();
        return response()->json($conceptNotes, 200);
    }
    
    public function show($id)
    {
        $conceptNote = ConceptNote::with(['user', 'sector', 'plans'])->find($id);
        if ($conceptNote) {
            return response()->json($conceptNote, 200);
        } else {
            return response()->json(['message' => 'Concept Note not found'], 404);
        }
    }    

    public function storeOrUpdate(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'selected_plans' => 'required|json',
            'projectname' => 'required|string',
            'shortname' => 'nullable|string',
            'sector_id' => 'required|integer|exists:sectors,id',
            'startdate' => 'required|date',
            'enddate' => 'required|date|after_or_equal:startdate',
            'description' => 'nullable|string',
            'process_status' => 'nullable|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        $data['createdby'] = Auth::id();

        ConceptNote::updateOrCreate(
            ['id' => $request->input('id')], 
            $data
        );

        return response()->json(['message' => 'Concept Note saved successfully.',], 200);
    }

    public function destroy($id)
    {
        $conceptNote = ConceptNote::find($id);
        if (!$conceptNote) {
            return response()->json(['message' => 'Concept Note not found'], 404);
        }

        $conceptNote->delete();
        return response()->json(['message' => 'Concept Note deleted successfully'], 200);
    }
}
