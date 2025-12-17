<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GroomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\AdminGroomerController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminAppointmentController;

// 🏠 Homepage
Route::get('/', function () {
    return view('home'); // resources/views/home.blade.php
});

// 👤 Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// 🐾 Client dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/client', [AppointmentController::class, 'dashboard'])->name('client.dashboard');
});

// ✂️ Groomer dashboard + actions
Route::middleware(['auth'])->group(function () {
    Route::get('/groomer', [GroomerController::class, 'index'])->name('groomer.dashboard');

    // ✅ Match Blade route names
    Route::patch('/groomer/appointments/{appointment}/status', [GroomerController::class, 'updateStatus'])
        ->name('groomer.updateStatus');

    Route::patch('/groomer/appointments/{appointment}/notes', [GroomerController::class, 'updateNotes'])
        ->name('groomer.updateNotes');
});

// 📅 Appointments (full CRUD for clients)
Route::resource('appointments', AppointmentController::class);
Route::resource('services', ServiceController::class);

// 🐶 Services page
Route::get('/services', function () {
    return view('services'); // resources/views/services.blade.php
});

// ℹ️ About page
Route::get('/about', function () {
    return view('about');
});

// 🛠 Admin dashboard + resources
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Resource controllers
    Route::resource('clients', AdminClientController::class);
    Route::resource('groomers', AdminGroomerController::class);
    Route::resource('services', AdminServiceController::class);
    Route::resource('appointments', AdminAppointmentController::class);

    // ✅ Custom POST route for groomer assignment
    Route::post('/appointments/{appointment}/assign-groomer', [AdminAppointmentController::class, 'assignGroomer'])
        ->name('appointments.assignGroomer');
});