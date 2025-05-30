<?php

use App\Http\Controllers\Admin\BotQuestionController;
use App\Http\Controllers\Admin\ContactMessageAdminController;
use App\Http\Controllers\Admin\TeacherApplicationAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfile;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentSubmissionController;
use App\Http\Controllers\BotChatController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\TeacherApplicationController;
use App\Http\Controllers\TeacherController;

use App\Http\Controllers\TestController;
use App\Http\Controllers\TestPassController;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{lang}',[HomeController::class, 'switchLang'])->name('lang.switch');
Auth::routes();
Route::get('/gd-check', fn() => extension_loaded('gd') ? 'GD OK ✅' : 'NO GD ❌');
Route::post('/bot-chat/ask', [BotChatController::class, 'ask'])->name('bot.chat.ask');
Route::get('/teachers/{id}', [TeacherController::class, 'showStud'])->name('teacherss.show');


//Auth Users
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/notifications/all', [NotificationController::class, 'index'])->name('notifications.all');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');
    Route::get('/become-teacher', [TeacherApplicationController::class, 'form'])->name('teacher.form');
    Route::post('/become-teacher', [TeacherApplicationController::class, 'store'])->name('teacher.apply');


    Route::post('/courses/{course}/complete', [CourseController::class, 'complete'])
        ->name('courses.complete');
    Route::get('/lessons/{lesson}/tests/create', [TestController::class, 'create'])->name('tests.create');
    Route::post('/lessons/{lesson}/tests', [TestController::class, 'store'])->name('tests.store');

    Route::post('/courses/{course}/reviews', [CourseReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [CourseReviewController::class, 'destroy'])->name('reviews.destroy');


    Route::get('/tests/{test}/pass', [TestPassController::class, 'show'])->name('tests.pass');
    Route::post('/tests/{test}/submit', [TestPassController::class, 'submit'])->name('tests.submit');
    Route::get('/courses/{course}/progress', [StudentCourseController::class, 'progress'])->name('courses.progress');
    Route::get('/courses/{course}/certificate', [CertificateController::class, 'download'])
        ->middleware('auth')
        ->name('courses.certificate');

    Route::get('/paypal/pay/{course}', [PayPalPaymentController::class, 'process'])->name('paypal.pay');
    Route::get('/paypal/success/{course}', [PayPalPaymentController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel', [PayPalPaymentController::class, 'cancel'])->name('paypal.cancel');


    Route::get('/courses/{id}/grade', [CourseController::class, 'calculateFinalGradeForStudentStudent'])->middleware('auth')->name('student.courses.final-grade');
    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('student.courses.my');
    Route::get('/teacher/courses/{id}/students', [TeacherController::class, 'students'])->middleware(['auth'])->name('teacher.courses.students');
    Route::post('/assignments/submission/{id}/grade', [AssignmentSubmissionController::class, 'grade'])->name('assignment.grade');

    Route::get('/api/get-plan-price/{id}', function ($id) {
        $plan = Plan::findOrFail($id);
        $usd = round($plan->price / 470, 2); // Примерно по текущему курсу
        return response()->json(['price' => $usd]);
    });

    Route::get('/student/courses/{id}', [CourseController::class, 'showForStudent'])->name('student.courses.show');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/courses', [CourseController::class, 'index'])->name('teacher.courses.index');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('teacher.courses.show');
    Route::get('/stud', [CourseController::class, 'indexstud'])->name('student.courses.index');
    // Преподаватель создает задание для урока
    Route::post('/lessons/{lesson}/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
    // Студент отправляет выполнение задания
    Route::post('/assignments/{assignment}/submissions', [AssignmentSubmissionController::class, 'store'])->name('submissions.store');


Route::middleware(['role:admin'])->group(function () {

    Route::get('admin/bot/', [BotQuestionController::class, 'index'])->name('admin.bot.index');
    Route::get('admin/bot/create', [BotQuestionController::class, 'create'])->name('admin.bot.create');
    Route::post('admin/bot/', [BotQuestionController::class, 'store'])->name('admin.bot.store');
    Route::get('admin/bot/{id}/edit', [BotQuestionController::class, 'edit'])->name('admin.bot.edit');
    Route::put('admin/bot/{id}', [BotQuestionController::class, 'update'])->name('admin.bot.update');
    Route::delete('admin/bot/{id}', [BotQuestionController::class, 'destroy'])->name('admin.bot.destroy');


    Route::get('/contacts', [ContactMessageAdminController::class, 'index'])->name('contacts.index');
    Route::post('/contacts/{id}/reply', [ContactMessageController::class, 'reply'])->name('contacts.reply');


    Route::get('/teacher-applications', [TeacherApplicationController::class, 'index'])->name('teacher-applications.index');
    Route::post('/teacher-applications/{id}/accept', [TeacherApplicationController::class, 'accept'])->name('teacher-applications.accept');
    Route::post('/teacher-applications/{id}/reject', [TeacherApplicationController::class, 'reject'])->name('teacher-applications.reject');

    Route::get('/admin/sales-statistics', [\App\Http\Controllers\Admin\StatisticsController::class, 'sales'])->name('admin.statistics.sales');

    Route::get('/support', [AIChatController::class, 'index'])->name('support.index');
    Route::post('/support/ask', [AIChatController::class, 'ask'])->name('support.ask');

    Route::get('/logins', [AdminController::class, 'log'])->name('admin.logins.index');

    Route::get('admin/profile', [AdminProfile::class, 'edit'])->name('admin.profile');
    Route::post('admin/profile/update', [AdminProfile::class, 'update'])->name('admin.profile.update');
    Route::post('admin/profile/password', [AdminProfile::class, 'updatePassword'])->name('admin.profile.password');

    Route::get('/admin/activity', [\App\Http\Controllers\AdminController::class, 'activityLog'])->name('admin.activity');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::get('/categories', [\App\Http\Controllers\AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [\App\Http\Controllers\AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/categories/{id}', [\App\Http\Controllers\AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboards');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/courses/{id}/approve', [AdminController::class, 'approve'])->name('admin.courses.approve');
    Route::post('/courses/{id}/reject', [AdminController::class, 'reject'])->name('admin.courses.reject');
    Route::get('/admin/users', [AdminController::class, 'index1'])->name('admin.users');
    Route::get('/admin/pending', [AdminController::class, 'index2'])->name('pending');
    Route::get('/admin/user/{id}/edit', [AdminController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [AdminController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.delete');
    Route::get('/admin/user/create', [AdminController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user', [AdminController::class, 'store'])->name('admin.user.store');

    Route::get('/admin/courses', [CourseController::class, 'adminindex'])->name('admin.admincourses');
    Route::get('/admin/courses/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/admin/courses/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/admin/courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
    Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/admin/courses', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/admin/courses/{id}', [CourseController::class, 'show'])->name('admin.courses.show');

    Route::get('/admin/lessons', [AdminController::class, 'indexlesson'])->name('admin.adminlessons');
    Route::delete('/admin/lessons/{id}', [AdminController::class, 'destroylesson'])->name('admin.lessons.destroy');
});

Route::middleware(['role:teacher'])->group(function () {
     Route::get('assignments/{assignment}', [AssignmentController::class, 'showassign'])->name('assignments.show');
     Route::get('assignments', [AssignmentController::class, 'indexassign'])->name('assignments.index');
     Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
     Route::get('/teacher/courses', [TeacherController::class, 'index1'])->name('teacher.courses');
     Route::get('/teacher/courses/create', [TeacherController::class, 'create'])->name('teacher.courses.create');
     Route::post('/teacher/courses', [TeacherController::class, 'store'])->name('teacher.courses.store');

     Route::get('/teacher/courses/{course_id}/lesson/create', [TeacherController::class, 'addLesson'])->name('teacher.lesson.create');
     Route::post('/teacher/courses/{course_id}/lesson', [TeacherController::class, 'storeLesson'])->name('teacher.lesson.store');
     Route::get('/teacher/lessons/{lesson_id}/task/create', [TeacherController::class, 'addTask'])->name('teacher.task.create');
     Route::post('/teacher/lessons/{lesson_id}/task', [TeacherController::class, 'storeTask'])->name('teacher.task.store');
    });
});
