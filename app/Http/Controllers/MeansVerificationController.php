<?php

namespace App\Http\Controllers;

use App\Models\MeansVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MeansVerificationController extends Controller
{
    public function index()
    {
        $meansVerifications = MeansVerification::all();
        return response()->json($meansVerifications);
    }

    public function show($id)
    {
        $meansVerification = MeansVerification::find($id);
        return $meansVerification ? response()->json($meansVerification) : response()->json(['message' => 'Means verification not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'projectproposal_id' => 'required|integer',
            'source' => 'required|string',
            'source_type' => 'required|string',
            'how_data_obtained' => 'required|string',
            'where_data_obtained' => 'required|string',
            'status' => 'required|string',
            'created_by' => 'required|string',
        ]);

        $id = $request->input('id');

        if ($id) {
            $meansVerification = MeansVerification::find($id);
            if ($meansVerification) {
                $meansVerification->update($request->all());
                return response()->json(['message' => 'Means verification updated successfully', 'meansVerification' => $meansVerification]);
            } else {
                return response()->json(['message' => 'Means verification not found'], 404);
            }
        } else {
            $meansVerification = MeansVerification::create($request->all());
            return response()->json(['message' => 'Means verification created successfully', 'meansVerification' => $meansVerification], 201);
        }
    }

    public function destroy($id)
    {
        $meansVerification = MeansVerification::find($id);
        if ($meansVerification) {
            $meansVerification->delete();
            return response()->json(['message' => 'Means verification deleted successfully']);
        } else {
            return response()->json(['message' => 'Means verification not found'], 404);
        }
    }
}
