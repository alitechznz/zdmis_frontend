<?php

namespace App\Http\Controllers;

use App\Models\ProjectCalender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectCalenderController extends Controller
{
   
    public function index()
    {
        $calenders = ProjectCalender::all();
        return response()->json($calenders, 200);
    }

  
    public function show($id)
    {
        $calender = ProjectCalender::find($id);

        if ($calender) {
            return response()->json($calender, 200);
        } else {
            return response()->json(['message' => 'Project Calendar not found'], 404);
        }
    }


    public function storeOrUpdate(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'activity' => 'required|string|max:255',
            'action' => 'required|string|max:255',
            'startdate' => 'required|date',
            'enddate' => 'required|date|after_or_equal:startdate',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }
       
        ProjectCalender::updateOrCreate(
            ['id' => $request->id], 
            $request->only('activity', 'action', 'startdate', 'enddate')
        );
    
        return response()->json(['message' => 'Successfully.'], 200);
    }
    

    public function destroy($id)
    {
        $calender = ProjectCalender::find($id);

        if (!$calender) {
            return response()->json(['message' => 'Project Calendar not found'], 404);
        }

        $calender->delete();
        return response()->json(['message' => 'Project Calendar deleted successfully'], 200);
    }
}
