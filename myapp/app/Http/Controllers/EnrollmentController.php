<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Get all enrollments
    public function index()
    {
        return response()->json(Enrollment::all());
    }

    // Store new enrollment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollno' => 'required|string|max:255',
            'batch' => 'required|string',
            'studentn' => 'required|string',
            'joindate' => 'required|string',
            'fee' => 'required|numeric',
        ]);

        $enrollment = Enrollment::create($validated);

        return response()->json([
            'message' => 'Enrollment created successfully!',
            'enrollment' => $enrollment,
        ], 201);
    }

    // Show one enrollment
    public function show(Enrollment $enrollment)
    {
        return response()->json($enrollment);
    }

    // Update existing enrollment
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'enrollno' => 'required|string|max:255',
            'batch' => 'required|string',
            'studentn' => 'required|string',
            'joindate' => 'required|string',
            'fee' => 'required|numeric',
        ]);

        $enrollment->update($validated);

        return response()->json([
            'message' => 'Enrollment updated successfully!',
            'enrollment' => $enrollment,
        ]);
    }

    // Delete enrollment
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return response()->json([
            'message' => 'Enrollment deleted successfully!',
        ]);
    }
}
