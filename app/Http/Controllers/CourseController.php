<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Список курсов
    public function index()
    {
        $courses = Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    // Просмотр одного курса с уроками
    public function show($id)
    {
        $course = Course::with('lessons')->findOrFail($id);
        return view('teacher.courses.show', compact('course'));
    }
}
