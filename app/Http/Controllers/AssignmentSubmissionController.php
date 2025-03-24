<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentSubmissionController extends Controller
{
    public function store(Request $request, Assignment $assignment)
    {
        $submission = null;
        // Только студенты могут отправлять задания
        if (Auth::user()->isTeacher()) {
            abort(403);
        }

        // Проверка: уже отправлял?
        $existingSubmission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', Auth::id())
            ->first();

        if ($existingSubmission) {
            return redirect()->back()->with('warning', 'Вы уже отправили задание.');
        }

        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mov,doc,docx,ppt,pptx,txt,pdf|max:102400',
        ]);

        $path = $request->file('video')->store('assignments', 'public');

        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'student_id'    => Auth::id(),
            'video'         => $path,
        ]);

        return redirect()->back()->with('success', 'Домашнее задание отправлено.');
    }


}
