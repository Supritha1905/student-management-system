<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\RedirectIfAdminAuthenticated::class)->group(function () {
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class)->except(['show']);
    Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
    Route::get('/admin/password/change', [AdminAuthController::class, 'showChangePasswordForm'])->name('admin.password.form');
    Route::post('/admin/password/change', [AdminAuthController::class, 'changePassword'])->name('admin.password.update');
    Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
});