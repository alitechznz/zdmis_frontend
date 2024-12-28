<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Region;
use App\Models\Shehia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function index(){
        $district = District::all();
        return response()->json($district);
    }

    public function create()
    {
        $region = Region::all();

        return response()->json($region);
    }

    public function storeOrUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        District::updateOrCreate(['id' => $request->id], $request->only('name', 'region_id', 'status'));

        return response()->json(['message' => 'District created successful'], 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $district = District::find($id);
        if(!$district){
            return response()->json('Record not found', 404);
        }
        if($district->status == 'active'){
            $district->status = 'inactive';
        } else {
            $district->status = 'active';
        }
        $district->save();
        return response()->json($district, 200);
    }
    public function show($id)
    {
        $district = District::with('region')->find($id);
        if(!$district){
            return response()->json('Record not found', 404);
        }

        return response()->json($district, 200);
    }

    public function destroy($id){
        $district = District::find($id);

        if (!$district) {
            return response()->json('district not found', 404);
        }

        $district->delete();
        return response()->json('district deleted successfully', 200);
    }
}
