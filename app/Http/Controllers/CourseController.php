<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Category;
use App\Models\Course;
use App\Models\CoursePurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function complete(Course $course)
    {
        $user = Auth::user();

        // Проверка: есть ли доступ
        if (!$user->courses->contains($course->id)) {
            abort(403);
        }

        $user->courses()->updateExistingPivot($course->id, [
            'is_completed' => true,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', __('main.course_completed'));
    }


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
            ->with('error', __('alert.course_deleted'));
    }


    public function indexstud(Request $request)
    {

        $courses = Course::where('status', 'approved')->with('category')->latest()->get();
        return view('student.courses.index', compact('courses'));
    }


    public function showForStudent($id)
    {
        $course = Course::where('id', $id)
            ->where('status', 'approved')
            ->with(['lessons', 'category', 'students', 'skills', 'user']) // добавим skills и user
            ->firstOrFail();

        $isEnrolled = CoursePurchase::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();

        // ===== РАССЧИТЫВАЕМ ПРОГРЕСС =====
        $lessonsWithTests = $course->lessons->filter(fn($lesson) => $lesson->test);
        $total = $lessonsWithTests->count();

        $passedTestIds = \App\Models\TestResult::where('user_id', auth()->id())
            ->where('passed', true)
            ->pluck('test_id');

        $passed = $lessonsWithTests->filter(fn($lesson) =>
            $lesson->test && $passedTestIds->contains($lesson->test->id)
        )->count();

        $progress = $total > 0 ? round(($passed / $total) * 100) : 0;

        // ===== РЕКОМЕНДАЦИИ =====
        $skillIds = $course->skills->pluck('id');

        $recommendedCourses = \App\Models\Course::where('id', '!=', $course->id)
            ->where('status', 'approved')
            ->where(function ($query) use ($skillIds, $course) {
                $query->whereHas('skills', fn($q) => $q->whereIn('skills.id', $skillIds))
                    ->orWhere('cat_id', $course->cat_id)
                    ->orWhere('teacher_id', $course->teacher_id);
            })
            ->with(['category'])
            ->take(4)
            ->get();

        return view('student.courses.show', compact('course', 'isEnrolled', 'progress', 'recommendedCourses'));
    }


    public function enroll($id)
    {
        $course = Course::findOrFail($id);
        $user = Auth::user();

        // Проверка, если уже записан
        if (!$user->enrolledCourses->contains($course->id)) {
            $user->enrolledCourses()->attach($course->id);
        }

        return redirect()->back()->with('success', __('alert.course_enrolled'));
    }
    public function myCourses()
    {
        $courses = Auth::user()->purchasedCourses()->with('category')->get();
        return view('student.courses.my', compact('courses'));
    }

    public function calculateFinalGradeForStudent($courseId)
    {
        $course = Course::with('lessons.assignments')->findOrFail($courseId);
        $student = Auth::user();

        $assignments = Assignment::whereHas('lesson', function ($q) use ($courseId) {
            $q->where('course_id', $courseId);
        })->get();

        $total = 0;
        $max = 0;

        foreach ($assignments as $assignment) {
            $submission = $assignment->submissions()
                ->where('student_id', $student->id)
                ->first();

            if ($submission && $submission->grade !== null) {
                $total += $submission->grade;
                $max += $assignment->max_score;
            }
        }

        $final = $max > 0 ? round(($total / $max) * 100) : null;

        return view('student.courses.final-grade', compact('course', 'final'));
    }


}
