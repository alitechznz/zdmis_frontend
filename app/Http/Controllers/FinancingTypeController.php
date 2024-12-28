<?php

namespace App\Http\Controllers;

use App\Models\FinancingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FinancingTypeController extends Controller
{
    public function index()
    {
        $financingTypes = FinancingType::all();
        return response()->json($financingTypes);
    }

    public function show($id)
    {
        $financingType = FinancingType::find($id);
        if ($financingType) {
            return response()->json($financingType);
        } else {
            return response()->json(['message' => 'Financing Type not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'created_by' => 'required|string|max:255',
        ]);

        $id = $request->input('id');

        if ($id) {
            $financingType = FinancingType::find($id);
            if ($financingType) {
                $financingType->update($request->all());
                return response()->json(['message' => 'Financing Type updated successfully', 'financing_type' => $financingType]);
            } else {
                return response()->json(['message' => 'Financing Type not found'], 404);
            }
        } else {
            $financingType = FinancingType::create($request->all());
            return response()->json(['message' => 'Financing Type created successfully', 'financing_type' => $financingType], 201);
        }
    }

    public function destroy($id)
    {
        $financingType = FinancingType::find($id);
        if ($financingType) {
            $financingType->delete();
            return response()->json(['message' => 'Financing Type deleted successfully']);
        } else {
            return response()->json(['message' => 'Financing Type not found'], 404);
        }
    }
}
