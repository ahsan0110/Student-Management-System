<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Get all students
    public function index()
{
    return response()->json(Student::all());
}


    // Store new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('students', 'public');
        $validated['image'] = $path;
    }

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Student created successfully!',
            'student' => $student,
        ], 201);
    }

    // Show one student (optional)
    public function show(Student $student)
    {
        return response()->json($student);
    }

    // Update existing student
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|numeric',
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Student updated successfully!',
            'student' => $student,
        ]);
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully!'
        ]);
    }
}
