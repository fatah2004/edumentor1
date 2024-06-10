<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminfeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MentorsController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;



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

Route::get('/', function () {
    return redirect('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home',[HomeController::class,'index'])->middleware(['auth', 'verified'])->name('home');


Route::middleware(['auth','verified','admin'])->group(function () {
    Route::get('/adminpage',[AdminController::class,'index'])->name('admin');
    Route::resource('training_sessions', TrainingSessionController::class);
    Route::resource('mentors', MentorsController::class);
    Route::get('admin_index', [AdminfeedbackController::class, 'index'])->name('feedback.adminindex');
    });

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/user/training-sessions', [UserController::class, 'trainingSessions'])->name('user.training_sessions');
    Route::get('/user/responsible-sessions', [UserController::class, 'responsibleSessions'])->name('user.responsible_sessions');
    Route::get('/responsible_sessions/{session}/submit', [UserController::class, 'showSessionForm'])->name('responsible_sessions.submit');
    Route::post('/responsible_sessions/{session}/submit', [UserController::class, 'createPostTrainingSession'])->name('responsible_sessions.createPost');
    Route::get('feedback/create/{session}', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
