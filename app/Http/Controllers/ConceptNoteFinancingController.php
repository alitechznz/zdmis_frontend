<?php

namespace App\Http\Controllers;
use App\Models\ConceptNoteFinancing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConceptNoteFinancingController extends Controller
{
    public function index()
    {
        $financings = ConceptNoteFinancing::all();
        return response()->json($financings);
    }

    public function show($id)
    {
        $financing = ConceptNoteFinancing::find($id);
        if ($financing) {
            return response()->json($financing);
        } else {
            return response()->json(['message' => 'Concept Note Financing not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note_financing_id' => 'required|integer',
            'type_finance_id' => 'required|integer',
            'sponsor_id' => 'required|integer',
            'currency_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'compensation_cost' => 'required|numeric',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'status' => 'required|string|max:50',
            'agreement_doc' => 'nullable|string',
            'created_by' => 'required|integer',
        ]);
    

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }
        ConceptNoteFinancing::updateOrCreate(
            ['id' => $request->input('id')],
            $validator->validated()
        );
    
        return response()->json(['message' => 'Concept Note Financing saved successfully.'], 200);
    }
    
    public function destroy($id)
    {
        $financing = ConceptNoteFinancing::find($id);
        if ($financing) {
            $financing->delete();
            return response()->json(['message' => 'Concept Note Financing deleted successfully']);
        } else {
            return response()->json(['message' => 'Concept Note Financing not found'], 404);
        }
    }
}
