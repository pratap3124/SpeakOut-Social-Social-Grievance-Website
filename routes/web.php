<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Authentication Routes
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


// Dashboard (after login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');;


// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);




use App\Http\Controllers\GrievanceController;

// Route to handle grievance submission
Route::post('/submit-grievance', [GrievanceController::class, 'submit'])->name('grievance.submit')->middleware('auth');

// Route to view the user's previous grievances and admin responses
Route::get('/grievance-responses', [GrievanceController::class, 'responses'])->name('grievance.responses')->middleware('auth');


// Route to handle feedback submission
Route::post('/grievance/{id}/feedback', [GrievanceController::class, 'feedback'])->name('grievance.feedback')->middleware('auth');



// Admin login routes
Route::get('/admin/login', [App\Http\Controllers\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminLoginController::class, 'login'])->name('admin.login.submit');

// Admin dashboard (secured, will protect this later)
use App\Http\Controllers\AdminController;

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/respond/{id}', [AdminController::class, 'respond'])->name('admin.respond');



Route::post('/admin/logout', function () {
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login');
})->name('admin.logout');
