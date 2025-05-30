<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function showStud($id)
    {
        $teacher = User::where('id', $id)->where('role', 'teacher')->firstOrFail();

        return view('teacher.show', compact('teacher'));
    }

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
        $pendingCourse = Course::where('teacher_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($pendingCourse) {
            return redirect()->route('teacher.courses')->with('error', __('alert.course_pending'));
        }
        $categories = Category::all();
        $skills = \App\Models\Skill::inRandomOrder()->limit(10)->get(); // или любой отбор
        return view('teacher.courses.create', compact('categories', 'skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'cat_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'difficulty' => 'nullable|string',
            'duration' => 'nullable|string',
            'requirements' => 'nullable|string',
            'is_certified' => 'nullable|boolean',
            'skills' => 'nullable|string', // теперь это строка
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
        }

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'cat_id' => $request->cat_id,
            'image' => $imagePath,
            'teacher_id' => Auth::id(),
            'status' => 'pending',
            'difficulty' => $request->difficulty,
            'duration' => $request->duration,
            'requirements' => $request->requirements,
            'is_certified' => $request->has('is_certified'),
        ]);

        // Обработка скиллов через запятую
        if (!empty($request->skills)) {
            $skillNames = array_filter(array_map('trim', explode(',', $request->skills)));
            $skillIds = [];

            foreach ($skillNames as $name) {
                $skill = \App\Models\Skill::firstOrCreate(['name' => $name]);
                $skillIds[] = $skill->id;
            }

            $course->skills()->sync($skillIds);
        }

        return redirect()->route('teacher.courses')->with('success', __('alert.course_created'));
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
            'is_preview' => 'nullable',

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
            'is_preview' => $request->has('is_preview'),

        ]);

        return redirect()->route('teacher.courses')->with('success', __('alert.lesson_added'));
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

        return redirect()->route('teacher.courses')->with('success', __('alert.task_added'));
    }

    public function students($id)
    {
        $course = Course::with('students')->findOrFail($id);

        // Проверка: чтобы чужие курсы нельзя было смотреть
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        return view('teacher.courses.students', compact('course'));
    }

}

