<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // Список всех пользователей
    public function index1()
    {
        $courses = Course::where('status', 'pending')->with('user')->get();
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function index2()
    {
        $courses = Course::where('status', 'pending')->with('user')->get();
        $users = User::all();
        return view('admin.index', compact('users', 'courses'));
    }

    // Подтвердить курс
    public function approve($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'approved';
        $course->save();

        return redirect()->back()->with('success', 'Курс подтвержден');
    }

    // Отклонить курс
    public function reject($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'rejected';
        $course->save();

        return redirect()->back()->with('error', 'Курс отклонен');
    }

    // Форма создания пользователя
    public function create()
    {
        return view('admin.users.create');
    }

    // Создание нового пользователя
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,teacher,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Пользователь создан!');
    }

    // Форма редактирования пользователя
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Обновление роли пользователя
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'role' => 'required|in:admin,teacher,user',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users')->with('success', 'Роль пользователя обновлена!');
    }

    // Удаление пользователя
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Пользователь удалён!');
    }

    /**
     * Display a listing of the lessons.
     */
    public function indexlesson()
    {
        // Eager load the course relationship for each lesson.
        $lessons = Lesson::with('course')->get();

        return view('admin.lessons.index', compact('lessons'));
    }

    /**
     * Remove the specified lesson from storage.
     */

    public function destroylesson($id)
    {
        $course = Lesson::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.adminlessons')
            ->with('success', 'Lesson deleted successfully.');
    }
}

