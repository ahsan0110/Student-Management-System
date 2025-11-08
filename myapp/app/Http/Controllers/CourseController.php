<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Get all courses
    public function index()
    {
        // Eager load the teacher relationship
        $courses = Course::with('teacher')->get();

        return response()->json($courses);
    }


    // Store new course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'syllabus' => 'required|string',
            'duration' => 'required|string',
            'teacher_id' => 'required|numeric',
        ]);

        $course = Course::create($validated);

        return response()->json([
            'message' => 'Course created successfully!',
            'course' => $course,
        ], 201);
    }

    // Show one course (optional)
    public function show(Course $course)
    {
        return response()->json($course);
    }

    // Update existing course
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'syllabus' => 'required|string',
            'duration' => 'required|string',
            'teacher_id' => 'required|numeric',
        ]);

        $course->update($validated);

        return response()->json([
            'message' => 'Course updated successfully!',
            'course' => $course,
        ]);
    }

    // Delete course
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json([
            'message' => 'Course deleted successfully!'
        ]);
    }
}
