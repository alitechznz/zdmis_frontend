<?php

namespace App\Http\Controllers;

use App\Models\ConceptNotePlanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ConceptNotePlanDetailController extends Controller
{
    public function index()
    {
        $planDetails = ConceptNotePlanDetail::all();
        return response()->json($planDetails);
    }

    public function show($id)
    {
        $planDetail = ConceptNotePlanDetail::find($id);
        if ($planDetail) {
            return response()->json($planDetail);
        } else {
            return response()->json(['message' => 'Concept Note Plan Detail not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'concept_note_id' => 'required|integer',
            'project_detail_type' => 'required|string|max:255',
            'project_detail' => 'required|string',
            'detail_status' => 'required|string|max:50',
            'detail_create_at' => 'required|date',
            'created_by' => 'required|integer',
        ]);

        $id = $request->input('id');

        if ($id) {
            $planDetail = ConceptNotePlanDetail::find($id);
            if ($planDetail) {
                $planDetail->update($request->all());
                return response()->json(['message' => 'Concept Note Plan Detail updated successfully', 'planDetail' => $planDetail]);
            } else {
                return response()->json(['message' => 'Concept Note Plan Detail not found'], 404);
            }
        } else {
            $planDetail = ConceptNotePlanDetail::create($request->all());
            return response()->json(['message' => 'Concept Note Plan Detail created successfully', 'planDetail' => $planDetail], 201);
        }
    }

    public function destroy($id)
    {
        $planDetail = ConceptNotePlanDetail::find($id);
        if ($planDetail) {
            $planDetail->delete();
            return response()->json(['message' => 'Concept Note Plan Detail deleted successfully']);
        } else {
            return response()->json(['message' => 'Concept Note Plan Detail not found'], 404);
        }
    }
}
