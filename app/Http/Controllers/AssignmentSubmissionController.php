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
        // Только студенты могут отправлять задания
        if (Auth::user()->isTeacher()) {
            abort(403);
        }

        $request->validate([
            // Здесь изменили валидацию, чтобы принимать не только видео, но и документы, презентации, текстовые файлы и PDF
            'video' => 'required|file|mimes:mp4,avi,mov,doc,docx,ppt,pptx,txt,pdf|max:102400', // ограничение 100MB
        ]);

        // Сохраняем загруженный файл в публичное хранилище (не забудьте выполнить php artisan storage:link)
        $path = $request->file('video')->store('assignments', 'public');

        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'student_id'    => Auth::id(),
            'video'         => $path, // Если нужно, можно переименовать поле в file
        ]);

        return redirect()->back()->with('success', 'Домашнее задание отправлено.');
    }

}
