<?php

namespace App\Http\Controllers;

use App\Models\MunicipalCouncil;
use App\Models\RegionalAuthority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MunicipalCouncilController extends Controller
{
    public function index()
    {
        $municipalCouncils = MunicipalCouncil::with('regionalAuthority', 'creator')->get();
        return response()->json($municipalCouncils);
    }

    public function create()
    {
        $regional_authorities = RegionalAuthority::all();

        return response()->json($regional_authorities);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'regional_authority_id' => 'required|exists:regional_authorities,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create or update the municipal council
        $municipalCouncil = MunicipalCouncil::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('regional_authority_id', 'name')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    public function show($id)
    {
        $municipalCouncil = MunicipalCouncil::with('regionalAuthority')->find($id);

        if (!$municipalCouncil) {
            return response()->json(['message' => 'Municipal council not found'], 404);
        }

        return response()->json($municipalCouncil, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $regionalAuthority = MunicipalCouncil::find($id);
        if(!$regionalAuthority){
            return response()->json('Municipal council not found', 404);
        }
        if($regionalAuthority->status == 'active'){
            $regionalAuthority->status = 'inactive';
        } else {
            $regionalAuthority->status = 'active';
        }
        $regionalAuthority->save();
        return response()->json($regionalAuthority, 200);
    }

    public function destroy($id)
    {
        $municipalCouncil = MunicipalCouncil::find($id);

        if (!$municipalCouncil) {
            return response()->json(['message' => 'Municipal council not found'], 404);
        }

        $municipalCouncil->delete();

        return response()->json(['message' => 'Municipal council deleted successfully']);
    }
}

