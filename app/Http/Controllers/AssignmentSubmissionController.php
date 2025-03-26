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
        if (Auth::user()->isTeacher()) {
            abort(403);
        }

        $existing = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', Auth::id())
            ->first();

        if ($existing) {
            return redirect()->back()->with('warning', 'Вы уже отправили задание.');
        }

        $request->validate([
            'files' => 'required',
            'files.*' => 'file|mimes:mp4,avi,mov,doc,docx,ppt,pptx,txt,pdf|max:102400',
        ]);

        $paths = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $paths[] = $file->store('assignments', 'public');
            }
        }

        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'student_id'    => Auth::id(),
            'files'         => json_encode($paths),
        ]);

        return redirect()->back()->with('success', 'Домашнее задание отправлено.');
    }

    public function grade(Request $request, $id)
    {
        $request->validate([
            'grade' => 'required|integer|min:0|max:100',
            'comment' => 'nullable|string|max:1000',
        ]);

        $submission = AssignmentSubmission::findOrFail($id);
        $submission->grade = $request->grade;
        $submission->comment = $request->comment;
        $submission->save();

        return back()->with('success', 'Оценка сохранена!');
    }


}
