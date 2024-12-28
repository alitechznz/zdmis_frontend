<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\RegionalAuthority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionalAuthorityController extends Controller
{
    public function index()
    {
        $regionalAuthorities = RegionalAuthority::with('region', 'creator')->get();
        return response()->json($regionalAuthorities);
    }

    public function create(){
        $region = Region::all();

        return response()->json(['region' =>$region]);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'region_id' => 'required|exists:regions,id',
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create or update the regional authority
        $regionalAuthority = RegionalAuthority::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('region_id', 'name', 'type')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    public function show($id)
    {
        $regionalAuthority = RegionalAuthority::with('region')->find($id);

        if (!$regionalAuthority) {
            return response()->json(['message' => 'Regional authority not found'], 404);
        }

        return response()->json($regionalAuthority, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $regionalAuthority = RegionalAuthority::find($id);
        if(!$regionalAuthority){
            return response()->json('Unit not found', 404);
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
        $regionalAuthority = RegionalAuthority::find($id);

        if (!$regionalAuthority) {
            return response()->json(['message' => 'Regional authority not found'], 404);
        }

        $regionalAuthority->delete();

        return response()->json(['message' => 'Regional authority deleted successfully']);
    }
}

