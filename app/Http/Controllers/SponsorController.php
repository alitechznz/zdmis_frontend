<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
{
  
    public function index()
    {
        $sponsors = Sponsor::with('country')->get();  
        return response()->json($sponsors, 200);
    }

   
    public function show($id)
    {
        $sponsor = Sponsor::with('country')->find($id);
        if ($sponsor) {
            return response()->json($sponsor, 200);
        } else {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'org_name' => 'required|string',
            'short_name' => 'nullable|string',
            'country_id' => 'required|integer',
            'organazation_category' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'contact_details' => 'nullable|string',
            'register_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if ($id) {
         
            $sponsor = Sponsor::find($id);
            if (!$sponsor) {
                return response()->json(['message' => 'Sponsor not found'], 404);
            }
            $sponsor->update($validator->validated());
            return response()->json(['message' => 'Sponsor updated successfully', 'data' => $sponsor], 200);
        } else {
          
            $sponsor = Sponsor::create($validator->validated());
            return response()->json(['message' => 'Sponsor created successfully', 'data' => $sponsor], 201);
        }
    }

    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);
        if (!$sponsor) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }

        $sponsor->delete();
        return response()->json(['message' => 'Sponsor deleted successfully'], 200);
    }
}
