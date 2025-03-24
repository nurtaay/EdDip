<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        return view('teacher.dashboard');
    }

    //  Список курсов
    public function index1()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.courses.index', compact('courses'));
    }

    //  Создание курса
    public function create()
    {
        $categories = Category::all();
        return view('teacher.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'cat_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
        }

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'cat_id' => $request->cat_id,
            'image' => $imagePath,
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->route('teacher.courses')->with('success', 'Курс создан!');
    }

    //  Добавление урока
    public function addLesson($course_id)
    {
        return view('teacher.lessons.create', compact('course_id'));
    }

    public function storeLesson(Request $request, $course_id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'video' => 'mimes:mp4,mov,avi,wmv|max:20480',
        ]);

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('lessons', 'public');
        }

        Lesson::create([
            'course_id' => $course_id,
            'title' => $request->title,
            'content' => $request->content,
            'video' => $videoPath,
        ]);

        return redirect()->route('teacher.courses')->with('success', 'Урок добавлен!');
    }

    //  Добавление задания к уроку
    public function addTask($lesson_id)
    {
        return view('teacher.tasks.create', compact('lesson_id'));
    }

    public function storeTask(Request $request, $lesson_id)
    {
        $request->validate([
            'task_text' => 'required',
        ]);

        Task::create([
            'lesson_id' => $lesson_id,
            'task_text' => $request->task_text,
        ]);

        return redirect()->route('teacher.courses')->with('success', 'Задание добавлено!');
    }
}

