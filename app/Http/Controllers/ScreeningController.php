<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function index()
    {
        $screenings = Screening::all();
        return response()->json($screenings);
    }

    public function show($id)
    {
        $screening = Screening::find($id);
        return $screening ? response()->json($screening) : response()->json(['message' => 'Screening not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'conceptnote_id' => 'required|integer',
            'projectquestion_id' => 'required|integer',
            'answer' => 'required|string',
            'section' => 'required|string',
            'comment' => 'required|string',
            'actiont' => 'required|string',
            'created_by' => 'required|integer',
        ]);

        $id = $request->input('id');

        if ($id) {
            $screening = Screening::find($id);
            if ($screening) {
                $screening->update($request->all());
                return response()->json(['message' => 'Screening updated successfully', 'screening' => $screening]);
            } else {
                return response()->json(['message' => 'Screening not found'], 404);
            }
        } else {
            $screening = Screening::create($request->all());
            return response()->json(['message' => 'Screening created successfully', 'screening' => $screening], 201);
        }
    }

    public function destroy($id)
    {
        $screening = Screening::find($id);
        if ($screening) {
            $screening->delete();
            return response()->json(['message' => 'Screening deleted successfully']);
        } else {
            return response()->json(['message' => 'Screening not found'], 404);
        }
    }
}
