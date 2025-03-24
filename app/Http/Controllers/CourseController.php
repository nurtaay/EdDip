<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Display a listing of the courses.
    public function adminindex()
    {
        // Eager load the user relationship for performance.
        $courses = Course::with('user')->get();

        return view('admin.courses.index', compact('courses'));
    }

    // Список курсов
    public function index()
    {
        $courses = Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    // Просмотр одного курса с уроками
    public function show($id)
    {
        $course = Course::with(['lessons', 'category'])->findOrFail($id);
        return view('teacher.courses.show', compact('course'));
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.admincourses')
            ->with('success', 'Course deleted successfully.');
    }


    public function indexstud()
    {
        $courses = Course::where('status', 'approved')->with('category')->latest()->get();
        return view('student.courses.index', compact('courses'));
    }


    public function showForStudent($id)
    {
        $course = Course::where('id', $id)
            ->where('status', 'approved')
            ->with(['lessons', 'category'])
            ->firstOrFail();

        return view('student.courses.show', compact('course'));
    }


}
