<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [StudentController::class, 'index'])->name('student.index');
route::get('/result', [StudentController::class, 'index'])->name('student.index');
route::get('/result/search', [StudentController::class, 'search'])->name('student.search');


Route::prefix('admin')->group(function() {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('signup', [AdminAuthController::class, 'showSignupForm'])->name('admin.signup');
    Route::post('signup', [AdminAuthController::class, 'signup'])->name('admin.signup.submit');


    Route::middleware('auth:admin')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');

        Route::middleware('superadmin')->group(function() {
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
        Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    });
    });
});
