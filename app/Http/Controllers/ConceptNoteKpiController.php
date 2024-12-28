<?php

namespace App\Http\Controllers;

use App\Models\ConceptNoteKpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ConceptNoteKpiController extends Controller
{
    public function index()
    {
        $kpis = ConceptNoteKpi::all();
        return response()->json($kpis);
    }

    public function show($id)
    {
        $kpi = ConceptNoteKpi::find($id);
        if ($kpi) {
            return response()->json($kpi);
        } else {
            return response()->json(['message' => 'KPI not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'concept_note_output_id' => 'required|integer',
            'createdby' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }
    
        ConceptNoteKpi::updateOrCreate(
            ['id' => $request->input('id')],
            $validator->validated()
        );
    
        return response()->json(['message' => 'KPI saved successfully.'], 200);
    }
    

    public function destroy($id)
    {
        $kpi = ConceptNoteKpi::find($id);
        if ($kpi) {
            $kpi->delete();
            return response()->json(['message' => 'KPI deleted successfully']);
        } else {
            return response()->json(['message' => 'KPI not found'], 404);
        }
    }
}
