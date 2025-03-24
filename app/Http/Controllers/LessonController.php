<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(Lesson $lesson)
    {
        $submission = null;
        // Если для урока уже создано задание, получаем его
        $assignment = Assignment::where('lesson_id', $lesson->id)->first();

        return view('teacher.lessons.show', compact('lesson', 'assignment', 'submission'));
    }
}
