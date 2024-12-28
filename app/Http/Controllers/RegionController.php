<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index(){
        $regions = Region::all();
        return response()->json($regions);
    }

    public function storeOrUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        Region::updateOrCreate(['id' => $request->id], $request->only('name', 'status'));

        return response()->json(['message' => 'Region created successful'], 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $region = Region::find($id);
        if(!$region){
            return response()->json('Record not found', 404);
        }
        if($region->status == 'active'){
            $region->status = 'inactive';
        } else {
            $region->status = 'active';
        }
        $region->save();
        return response()->json($region, 200);
    }
    public function show($id)
    {
        $region = Region::find($id);
        if(!$region){
            return response()->json('Record not found', 404);
        }
        return response()->json($region, 200);
    }

    public function destroy($id){
        $region = Region::find($id);

        if (!$region) {
            return response()->json('Region not found', 404);
        }

        $region->delete();
        return response()->json('Region deleted successfully', 200);
    }
}
