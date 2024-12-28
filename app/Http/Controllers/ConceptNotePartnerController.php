<?php

namespace App\Http\Controllers;

use App\Models\ConceptNotePartners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ConceptNotePartnerController extends Controller
{
    public function index()
    {
        $partners = ConceptNotePartners::all();
        return response()->json($partners);
    }

    public function show($id)
    {
        $partner = ConceptNotePartners::find($id);
        if ($partner) {
            return response()->json($partner);
        } else {
            return response()->json(['message' => 'Concept Note Partner not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'concept_note_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'detail' => 'required|string',
            'create_at' => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $id = $request->input('id');
    
        $createdBy = auth()->id();
    
        if ($id) {
            $partner = ConceptNotePartners::find($id);
            if (!$partner) {
                return response()->json(['message' => 'Concept Note Partner not found'], 404);
            }
    
            $partner->update(array_merge($validator->validated(), ['created_by' => $createdBy]));
    
            return response()->json(['message' => 'Concept Note Partner updated successfully', 'partner' => $partner], 200);
        } else {

            $partner = ConceptNotePartners::create(array_merge($validator->validated(), ['created_by' => $createdBy]));
    
            return response()->json(['message' => 'Concept Note Partner created successfully', 'partner' => $partner], 201);
        }
    }
    
    public function destroy($id)
    {
        $partner = ConceptNotePartners::find($id);
        if ($partner) {
            $partner->delete();
            return response()->json(['message' => 'Concept Note Partner deleted successfully']);
        } else {
            return response()->json(['message' => 'Concept Note Partner not found'], 404);
        }
    }
}
