<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Shehia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShehiaController extends Controller
{
    public function index()
    {
        $shehias = Shehia::with('district')->get();
        return response()->json($shehias);
    }

    public function getByDistrict($districtId)
    {
        $shehias = Shehia::where('district_id', $districtId)->where('status', 'active')->get();
        return response()->json($shehias); // Ensure this line is active to return data

    }


    public function create(){
        $districts = District::all();

        return response()->json($districts);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $shehia = Shehia::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('district_id', 'created_by', 'name', 'status')
        );

        return response()->json(['message' => 'Shehia created successful'], 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $shehia = Shehia::find($id);
        if(!$shehia){
            return response()->json('Record not found', 404);
        }
        if($shehia->status == 'active'){
            $shehia->status = 'inactive';
        } else {
            $shehia->status = 'active';
        }
        $shehia->save();
        return response()->json($shehia, 200);
    }
    public function show($id)
    {
        $shehia = Shehia::with('district')->find($id);
        if(!$shehia){
            return response()->json('Record not found', 404);
        }

        return response()->json($shehia, 200);
    }

    public function destroy($id)
    {
        $shehia = Shehia::find($id);

        if (!$shehia) {
            return response()->json(['message' => 'Shehia not found'], 404);
        }

        $shehia->delete();

        return response()->json(['message' => 'Shehia deleted successfully']);
    }
}

