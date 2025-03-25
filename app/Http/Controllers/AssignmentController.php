<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    // Создание задания преподавателем (связь с уроком)
    public function store(Request $request, Lesson $lesson)
    {
        if (!Auth::user()->isTeacher()) {
            abort(403);
        }

        $request->validate([
            'description' => 'required|string'
        ]);

        // Создаём задание; предполагается, что в таблице assignments есть поля lesson_id и created_by
        $assignment = Assignment::create([
            'lesson_id'    => $lesson->id,
            'created_by'   => Auth::id(),
            'description'  => $request->description,
            'deadline' => $request->deadline,

        ]);

        return redirect()->route('assignments.show', $assignment->id)
            ->with('success', 'Домашнее задание создано.');
    }

    // Отображение задания и списка отправок (только для преподавателя, который его создал)
    public function showassign(Assignment $assignment)
    {
        if (!Auth::user()->isTeacher() || Auth::id() !== $assignment->created_by) {
            abort(403);
        }

        // Необходимо, чтобы в модели Assignment была определена связь submissions
        $submissions = $assignment->submissions;

        return view('assignments.show', compact('assignment', 'submissions'));
    }

    // Если нужен список заданий преподавателя
    public function indexassign()
    {
        if (!Auth::user()->isTeacher()) {
            abort(403);
        }

        $assignments = Assignment::where('created_by', Auth::id())->get();

        return view('assignments.show', compact('assignments'));
    }
}
