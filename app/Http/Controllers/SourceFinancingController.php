<?php

namespace App\Http\Controllers;

use App\Models\SourceFinancing;
use Illuminate\Http\Request;

class SourceFinancingController extends Controller
{
    public function index()
    {
        $sources = SourceFinancing::all();
        return response()->json($sources);
    }

    public function show($id)
    {
        $source = SourceFinancing::find($id);
        if ($source) {
            return response()->json($source);
        } else {
            return response()->json(['message' => 'Source Financing not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $id = $request->input('id');

        if ($id) {
            $source = SourceFinancing::find($id);
            if ($source) {
                $source->update($request->all());
                return response()->json(['message' => 'Source Financing updated successfully', 'source' => $source]);
            } else {
                return response()->json(['message' => 'Source Financing not found'], 404);
            }
        } else {
            $source = SourceFinancing::create($request->all());
            return response()->json(['message' => 'Source Financing created successfully', 'source' => $source], 201);
        }
    }

    public function destroy($id)
    {
        $source = SourceFinancing::find($id);
        if ($source) {
            $source->delete();
            return response()->json(['message' => 'Source Financing deleted successfully']);
        } else {
            return response()->json(['message' => 'Source Financing not found'], 404);
        }
    }
}
