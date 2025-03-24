<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $coursesCount = Course::count();
        $studentsCount = User::where('role', 'user')->count();
        $teachersCount = User::where('role', 'teacher')->count();

        $courses = Course::all();
        return view('home', compact('courses', 'coursesCount', 'studentsCount', 'teachersCount'));
    }
}
