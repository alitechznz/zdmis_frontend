<?php

namespace App\Http\Controllers;

use App\Models\FinanceParticular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FinanceParticularController extends Controller
{
    public function index()
    {
        $financeParticulars = FinanceParticular::all();
        return response()->json($financeParticulars);
    }

    public function show($id)
    {
        $financeParticular = FinanceParticular::find($id);
        if ($financeParticular) {
            return response()->json($financeParticular);
        } else {
            return response()->json(['message' => 'Finance Particular not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'status' => 'required|string',
        ]);

        $id = $request->input('id');

        if ($id) {
            $financeParticular = FinanceParticular::find($id);
            if ($financeParticular) {
                $financeParticular->update($request->all());
                return response()->json(['message' => 'Finance Particular updated successfully', 'financeParticular' => $financeParticular]);
            } else {
                return response()->json(['message' => 'Finance Particular not found'], 404);
            }
        } else {
            $financeParticular = FinanceParticular::create($request->all());
            return response()->json(['message' => 'Finance Particular created successfully', 'financeParticular' => $financeParticular], 201);
        }
    }

    public function destroy($id)
    {
        $financeParticular = FinanceParticular::find($id);
        if ($financeParticular) {
            $financeParticular->delete();
            return response()->json(['message' => 'Finance Particular deleted successfully']);
        } else {
            return response()->json(['message' => 'Finance Particular not found'], 404);
        }
    }
}
