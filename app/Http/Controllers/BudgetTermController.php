<?php

namespace App\Http\Controllers;

use App\Models\BudgetTerm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BudgetTermController extends Controller
{
    public function index()
    {
        $terms = BudgetTerm::all();
        return response()->json($terms, 200);
    }

    public function show($id)
    {
        $term = BudgetTerm::find($id);
        if ($term) {
            return response()->json($term, 200);
        } else {
            return response()->json(['message' => 'Budget Term not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }
    

        BudgetTerm::updateOrCreate(
            ['id' => $request->id], 
            $request->only('year', 'start_date', 'end_date', 'status') 
        );
    
        return response()->json(['message' => 'Successfully.'], 200);
    }
    

    public function destroy($id)
    {
        $term = BudgetTerm::find($id);
        if (!$term) {
            return response()->json(['message' => 'Budget Term not found'], 404);
        }

        $term->delete();
        return response()->json(['message' => 'Budget Term deleted successfully'], 200);
    }
}
