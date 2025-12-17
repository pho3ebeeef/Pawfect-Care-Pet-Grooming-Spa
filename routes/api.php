<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\NoteController;

// Example test route (to confirm API works)
Route::get('/ping', function () {
    return response()->json(['message' => 'API is working!']);
});

// Group routes that require authentication
Route::middleware('auth:sanctum')->group(function () {

    // --- Client-facing appointment routes ---
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::patch('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel']);

    // --- Admin/Receptionist appointment management ---
    Route::get('/admin/appointments', [AdminAppointmentController::class, 'index']);
    Route::patch('/admin/appointments/{appointment}/assign', [AdminAppointmentController::class, 'assignGroomer']);
    Route::patch('/admin/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus']);

    // --- Groomer notes ---
    Route::post('/appointments/{appointment}/note', [NoteController::class, 'store']);
    Route::patch('/notes/{note}', [NoteController::class, 'update']);
});

Route::get('/ping', function () {
    return response()->json(['message' => 'API is working!']);
});
