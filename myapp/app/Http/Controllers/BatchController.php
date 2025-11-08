<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    // Get all batches
    public function index()
    {
        $batches = Batch::all();
        return response()->json($batches);
    }

    // Store new batch
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course' => 'required|string',
            'startdate' => 'required|string',
        ]);

        $batch = Batch::create($request->only(['name', 'course', 'startdate']));
        return response()->json($batch, 201);
    }

    // Show a single batch
    public function show($id)
    {
        $batch = Batch::findOrFail($id);
        return response()->json($batch);
    }

    // Update existing batch
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course' => 'required|string',
            'startdate' => 'required|string',
        ]);

        $batch = Batch::findOrFail($id);
        $batch->update($request->only(['name', 'course', 'startdate']));

        return response()->json(['message' => 'Batch updated successfully', 'batch' => $batch]);
    }

    // Delete batch
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return response()->json(['message' => 'Batch deleted successfully']);
    }
}
