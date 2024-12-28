<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::with('responsibleUser')->get();
        return response()->json($sectors);
    }

    public function show($id)
    {
        $sector = Sector::with('responsibleUser')->find($id);
        if ($sector) {
            return response()->json($sector);
        } else {
            return response()->json(['message' => 'Sector not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'ministry_id' => 'required|exists:ministries,id', 
            'status' => 'required|string',
        ]);
    
      
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }
    
        Sector::updateOrCreate(
            ['id' => $request->id], 
            $request->only('name', 'ministry_id', 'status') 
        );
    
        return response()->json(['message' => 'Sector saved successfully.'], 200);
    }
    

    public function destroy($id)
    {
        $sector = Sector::find($id);
        if ($sector) {
            $sector->delete();
            return response()->json(['message' => 'Sector deleted successfully']);
        } else {
            return response()->json(['message' => 'Sector not found'], 404);
        }
    }
}
