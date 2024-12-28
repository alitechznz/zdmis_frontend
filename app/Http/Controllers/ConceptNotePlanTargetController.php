<?php

namespace App\Http\Controllers;

use App\Models\ConceptNotePlanTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ConceptNotePlanTargetController extends Controller
{
    public function index()
    {
        $targets = ConceptNotePlanTarget::all();
        return response()->json($targets);
    }

    public function show($id)
    {
        $target = ConceptNotePlanTarget::find($id);
        if ($target) {
            return response()->json($target);
        } else {
            return response()->json(['message' => 'Target not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'concept_note_plan_baseline_id' => 'required|integer',
            'status' => 'required|string',
            'value' => 'required|integer',
            'unit' => 'required|integer',
            'year' => 'required|integer',
            'created_by' => 'required|integer',
        ]);

        $id = $request->input('id');

        if ($id) {
            $target = ConceptNotePlanTarget::find($id);
            if ($target) {
                $target->update($request->all());
                return response()->json(['message' => 'Target updated successfully', 'target' => $target]);
            } else {
                return response()->json(['message' => 'Target not found'], 404);
            }
        } else {
            $target = ConceptNotePlanTarget::create($request->all());
            return response()->json(['message' => 'Target created successfully', 'target' => $target], 201);
        }
    }

    public function destroy($id)
    {
        $target = ConceptNotePlanTarget::find($id);
        if ($target) {
            $target->delete();
            return response()->json(['message' => 'Target deleted successfully']);
        } else {
            return response()->json(['message' => 'Target not found'], 404);
        }
    }
}
