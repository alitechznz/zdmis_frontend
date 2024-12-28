<?php

namespace App\Http\Controllers;

use App\Models\SubmissionTimeline;
use Illuminate\Http\Request;

class SubmissionTimelineController extends Controller
{
    public function index()
    {
        $timelines = SubmissionTimeline::all();
        return response()->json($timelines);
    }

    public function show($id)
    {
        $timeline = SubmissionTimeline::find($id);
        if ($timeline) {
            return response()->json($timeline);
        } else {
            return response()->json(['message' => 'Submission timeline not found'], 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'budget_term' => 'required|string',
            'report_type' => 'required|string',
            'date' => 'required|date',
        ]);

        $id = $request->input('id');

        if ($id) {
            $timeline = SubmissionTimeline::find($id);
            if ($timeline) {
                $timeline->update($request->all());
                return response()->json(['message' => 'Timeline updated successfully', 'timeline' => $timeline]);
            } else {
                return response()->json(['message' => 'Timeline not found'], 404);
            }
        } else {
            $timeline = SubmissionTimeline::create($request->all());
            return response()->json(['message' => 'Timeline created successfully', 'timeline' => $timeline], 201);
        }
    }

    public function destroy($id)
    {
        $timeline = SubmissionTimeline::find($id);
        if ($timeline) {
            $timeline->delete();
            return response()->json(['message' => 'Timeline deleted successfully']);
        } else {
            return response()->json(['message' => 'Timeline not found'], 404);
        }
    }
}
