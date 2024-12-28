<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImplementationRequest;
use Illuminate\Support\Facades\Validator;

class ImplementationRequestController extends Controller
{
    public function index()
    {
        $implementation = ImplementationRequest::all();
        return response()->json($implementation, 200);
    }

    public function storeOrUpdate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'contract' => 'nullable|file|mimes:pdf|max:2048',
            'invoice' => 'nullable|file|mimes:pdf|max:2048',
            'latter' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $implementation = ImplementationRequest::updateOrCreate([$request->id], $request->only(
            'contract','invoice','latter',
        ));

        if ($request->filled('comment')){
            if (empty($implementation->comment)) {
                $implementation->comments()->create(['text' => $request->comment]);
            } else {
                $implementation->comments()->update(['text' => $request->comment]);
            }
        }

        return response()->json(['message' => 'Created Successful'], 200);
    }

    public function show(implementationRequest $implementationRequest)
    {
        $implementation = $implementationRequest->with('comments')->get();
        return response()->json($implementation, 200);
    }

    public function verified(ImplementationRequest $implementationRequest, Request $request)
    {
        $validator = Validator::make($request->all(), ['is_verified' => 'required']);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $implementationRequest->update([
            'is_verified' => $request->is_verified,
        ]);

        if ($request->filled('comment')) {
            $implementationRequest->comments()->update(['text' => $request->comment]);
        }

        return response()->json(['message' => 'Verification Successful'], 200);
    }

    public function changeStatus(ImplementationRequest $implementationRequest, Request $request)
    {
        $validator = Validator::make($request->all(), ['status' => 'required']);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $implementationRequest->update([
            'status' => $request->is_verified,
        ]);

        if ($request->filled('comment')) {
            $implementationRequest->comments()->update(['text' => $request->comment]);
        }

        return response()->json(['message' => 'Confirmation Successful'], 200);
    }

    public function destroy(ImplementationRequest $implementationRequest)
    {
        if (!$implementationRequest){
            return response()->json(['message' => 'Implementation request not found'], 404);
        }
        $implementationRequest->delete();
        return response()->json(['message' => 'Delete Successful'], 200);
    }
}
