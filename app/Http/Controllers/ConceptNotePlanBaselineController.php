<?php

namespace App\Http\Controllers;

use App\Models\ConceptNotePlanBaseline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ConceptNotePlanBaselineController extends Controller
{
    public function index()
    {
        $baselines = ConceptNotePlanBaseline::all();
        return response()->json($baselines);
    }

    public function show($id)
    {
        $baseline = ConceptNotePlanBaseline::find($id);
        if ($baseline) {
            return response()->json($baseline);
        } else {
            return response()->json(['message' => 'Baseline not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kpi_id' => 'required|integer',
            'baseline_id' => 'nullable|string',
            'status' => 'required|string',
            'value' => 'required|integer',
            'unit' => 'required|integer',
            'year' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $id = $request->input('id');
    
        // Get the authenticated user's ID
        $createdBy = auth()->id();
    
        if ($id) {
            $baseline = ConceptNotePlanBaseline::find($id);
            if (!$baseline) {
                return response()->json(['message' => 'Baseline not found'], 404);
            }

            $baseline->update(array_merge($validator->validated(), ['created_by' => $createdBy]));
    
            return response()->json(['message' => 'Baseline updated successfully', 'baseline' => $baseline], 200);
        } else {
            $baseline = ConceptNotePlanBaseline::create(array_merge($validator->validated(), ['created_by' => $createdBy]));
    
            return response()->json(['message' => 'Baseline created successfully', 'baseline' => $baseline], 201);
        }
    }
    
    public function destroy($id)
    {
        $baseline = ConceptNotePlanBaseline::find($id);
        if ($baseline) {
            $baseline->delete();
            return response()->json(['message' => 'Baseline deleted successfully']);
        } else {
            return response()->json(['message' => 'Baseline not found'], 404);
        }
    }
}
