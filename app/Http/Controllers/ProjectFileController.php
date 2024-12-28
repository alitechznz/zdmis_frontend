<?php

namespace App\Http\Controllers;

use App\Models\ProjectFile;
use Illuminate\Http\Request;

class ProjectFileController extends Controller
{
    public function index()
    {
        $projectFiles = ProjectFile::all();
        return response()->json($projectFiles);
    }

    public function show($id)
    {
        $projectFile = ProjectFile::find($id);
        return $projectFile ? response()->json($projectFile) : response()->json(['message' => 'Project file not found'], 404);
    }

    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'projectproposal_id' => 'required|integer',
            'name' => 'required|string',
            'type' => 'required|string',
            'status' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string',
            'created_by' => 'required|string',
        ]);

        $id = $request->input('id');

        if ($id) {
            $projectFile = ProjectFile::find($id);
            if ($projectFile) {
                $projectFile->update($request->all());
                return response()->json(['message' => 'Project file updated successfully', 'projectFile' => $projectFile]);
            } else {
                return response()->json(['message' => 'Project file not found'], 404);
            }
        } else {
            $projectFile = ProjectFile::create($request->all());
            return response()->json(['message' => 'Project file created successfully', 'projectFile' => $projectFile], 201);
        }
    }

    public function destroy($id)
    {
        $projectFile = ProjectFile::find($id);
        if ($projectFile) {
            $projectFile->delete();
            return response()->json(['message' => 'Project file deleted successfully']);
        } else {
            return response()->json(['message' => 'Project file not found'], 404);
        }
    }
}
