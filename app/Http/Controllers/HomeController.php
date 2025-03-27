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

        $courses = Course::where('status', 'approved')->with('category')->latest()->get();
        return view('home', compact('courses', 'coursesCount', 'studentsCount', 'teachersCount'));
    }

    public function switchLang(Request $request, $lang){
        if(array_key_exists($lang, config('app.languages'))){
            $request->session()->put('mylocale', $lang);
        }
        return back();
    }
}
