<?php

namespace App\Http\Controllers;

use App\Models\AssignmentSubmission;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller{
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories')->with('success', __('alert.category_added'));
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories')->with('error', __('alert.category_deleted'));
    }
    public function subscriptions(Request $request)
    {
        $filter = $request->get('status');

        $query = Subscription::with('user');

        if ($filter === 'active') {
            $query->where('status', 'active')->where('end_date', '>=', now());
        } elseif ($filter === 'expired') {
            $query->where('status', 'expired')->orWhere('end_date', '<', now());
        }

        $subscriptions = $query->latest()->get();

        $totalRevenue = Subscription::where('status', 'active')
            ->where('end_date', '>=', now())
            ->join('plans', 'subscriptions.type', '=', 'plans.type')
            ->sum('plans.price');

        return view('admin.subscriptions', compact('subscriptions', 'filter', 'totalRevenue'));
    }

    public function cancelSubscription($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->status = 'canceled';
        $subscription->end_date = now();
        $subscription->save();

        return back()->with('success', __('alert.subscription_cancelled'));
    }
    public function dashboard()
    {
        $totalSubscriptions = Subscription::count();
        $activeSubscriptions = Subscription::where('status', 'active')
            ->where('end_date', '>=', now())
            ->count();
        $expiredSubscriptions = Subscription::where('status', 'expired')->count();

        return view('admin.dashboard', compact('totalSubscriptions', 'activeSubscriptions', 'expiredSubscriptions'));
    }

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

        return redirect()->back()->with('success', __('alert.course_approved'));
    }

    // Отклонить курс
    public function reject($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'rejected';
        $course->save();

        return redirect()->back()->with('error', __('alert.course_rejected'));
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

        return redirect()->route('admin.users')->with('success', __('alert.user_created'));
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

        return redirect()->route('admin.users')->with('success', __('alert.user_updated'));
    }

    // Удаление пользователя
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('error', __('alert.user_deleted'));
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
            ->with('error', __('alert.lesson_deleted'));
    }

    public function activityLog(Request $request)
    {
//        dd(session('locale'));
        $filterType = $request->get('type'); // course_registration, submission, payment
        $courseId = $request->get('course_id');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $courses = Course::all();

        // 1. Курс регистрации
        $courseRegistrations = DB::table('course_user')
            ->join('users', 'course_user.user_id', '=', 'users.id')
            ->join('courses', 'course_user.course_id', '=', 'courses.id')
            ->select('users.name as user', 'courses.title as course', 'course_user.created_at')
            ->when($courseId, fn($q) => $q->where('course_user.course_id', $courseId))
            ->when($startDate, fn($q) => $q->whereDate('course_user.created_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('course_user.created_at', '<=', $endDate))
            ->orderByDesc('course_user.created_at')
            ->get();

        // 2. Отправки заданий
        $submissions = AssignmentSubmission::with(['student', 'assignment.lesson.course'])
            ->when($courseId, fn($q) => $q->whereHas('assignment.lesson', fn($q) => $q->where('course_id', $courseId)))
            ->when($startDate, fn($q) => $q->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('created_at', '<=', $endDate))
            ->latest()
            ->get();

        // 3. Оплаты
        $payments = Subscription::with('user')
            ->when($startDate, fn($q) => $q->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('created_at', '<=', $endDate))
            ->latest()
            ->get();

        return view('admin.activity', compact(
            'courseRegistrations', 'submissions', 'payments',
            'filterType', 'courseId', 'startDate', 'endDate', 'courses'
        ));
    }

    public function settings()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'My Platform'),
            'support_email' => Setting::get('support_email', 'admin@example.com'),
            'banner_text' => Setting::get('banner_text'),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        Setting::set('site_name', $request->site_name);
        Setting::set('support_email', $request->support_email);
        Setting::set('banner_text', $request->banner_text);

        return back()->with('success', __('alert.settings_saved'));
    }


}

