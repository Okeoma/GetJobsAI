<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CVOptimizerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyInterviewsController;
use App\Http\Controllers\UserAccount;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('signin', [AuthController::class, 'store'])->name('signin.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');
Route::resource('user-account', UserAccount::class)->only(['create', 'store']);
Route::resource('dashboard', DashboardController::class)->only(['index'])->middleware('auth');
Route::resource('cv', CVOptimizerController::class)->only(['index', 'create', 'store', 'show', 'destroy'])->middleware('auth');
Route::resource('jobs', JobController::class)->only(['index'])->middleware('auth');
Route::get('/cv/{cv}/download', function (\App\Models\Cv $cv) {
    if (! Storage::disk('public')->exists($cv->original_cv_path)) {
        abort(404);
    }

    return Storage::disk('public')->download($cv->original_cv_path);
})->name('download');

Route::resource('interview', InterviewController::class)->only(['index', 'store'])->middleware('auth');
Route::post('/interview/create', [InterviewController::class, 'create'])->name('interview.create');
Route::resource('my-interview', MyInterviewsController::class)->middleware('auth')->only(['index', 'show', 'destroy']);
// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
