<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\MunicipalCouncil;
use App\Models\Shehia;
use App\Models\ShehiaCommittee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShehiaCommitteeController extends Controller
{
    public function index()
    {
        $shehia_committees = ShehiaCommittee::with('municipalCouncil', 'shehia')->get();
        return response()->json($shehia_committees);
    }

    public function create()
    {
        $shehias = Shehia::all();
        $municipal_councils = MunicipalCouncil::all();

        return response()->json(['shehias' => $shehias, 'municipal_councils' => $municipal_councils]);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'municipal_council_id' => 'required|exists:municipal_councils,id',
            'shehia_id' => 'required|exists:shehias,id',
            'contact_person' => 'required|string|max:255',
            'contact_detail' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create or update the shehia committee
        $shehia_committee = ShehiaCommittee::updateOrCreate(
            ['id' => $request->id], // Match by id if exists
            $request->only('municipal_council_id', 'shehia_id', 'contact_person', 'contact_detail', 'status')
        );

        return response()->json(['message' => 'Created successful'], 200);
    }

    public function show($id)
    {
        $shehia_committee = ShehiaCommittee::with('municipalCouncil')->find($id);

        if (!$shehia_committee) {
            return response()->json(['message' => 'Shehia committee not found'], 404);
        }

        return response()->json($shehia_committee, 200);
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $shehia_committee = ShehiaCommittee::find($id);
        if(!$shehia_committee){
            return response()->json('Shehia committee not found', 404);
        }
        if($shehia_committee->status == 'active'){
            $shehia_committee->status = 'inactive';
        } else {
            $shehia_committee->status = 'active';
        }
        $shehia_committee->save();
        return response()->json($shehia_committee, 200);
    }

    public function destroy($id)
    {
        $shehia_committee = ShehiaCommittee::find($id);

        if (!$shehia_committee) {
            return response()->json(['message' => 'Shehia committee not found'], 404);
        }

        $shehia_committee->delete();

        return response()->json(['message' => 'Shehia committee deleted successfully']);
    }
}

