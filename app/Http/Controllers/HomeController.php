<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $coursesCount = Course::count();
        $studentsCount = User::where('role', 'user')->count();
        $teachersCount = User::where('role', 'teacher')->count();

        $query = Course::where('status', 'approved')->with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('sort_by')) {
            $sort = $request->input('sort_by');
            if ($sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            // По умолчанию — новые
            $query->orderBy('created_at', 'desc');
        }

        $courses = $query->get();

        return view('home', compact('courses', 'coursesCount', 'studentsCount', 'teachersCount'));
    }

    public function switchLang(Request $request, $lang)
    {
        if (in_array($lang, ['ru', 'kz'])) {
            $request->session()->put('locale', $lang);
        }
        return back();
    }

}
