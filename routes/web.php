<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;

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

Auth::routes();
Route::middleware(['auth'])->group(function () {


    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/courses', [CourseController::class, 'index'])->name('teacher.courses.index');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('teacher.courses.show');


    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminController::class, 'index1'])->name('admin.users');
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
