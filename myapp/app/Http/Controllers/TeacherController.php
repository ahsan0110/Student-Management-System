<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Get all teachers
    public function index()
    {
        return response()->json(Teacher::all());
    }

    // Store new teacher
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|numeric',
        ]);

        $teacher = Teacher::create($validated);

        return response()->json([
            'message' => 'Teacher created successfully!',
            'teacher' => $teacher,
        ], 201);
    }

    // Show one teacher (optional)
    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    // Update existing teacher
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|numeric',
        ]);

        $teacher->update($validated);

        return response()->json([
            'message' => 'Teacher updated successfully!',
            'teacher' => $teacher,
        ]);
    }

    // Delete teacher
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return response()->json([
            'message' => 'Teacher deleted successfully!'
        ]);
    }
}
