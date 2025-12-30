<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthController;

// Public API Routes (no authentication needed)
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/complaints', [ComplaintController::class, 'store']);
Route::get('/complaints/ticket/{ticketNumber}', [ComplaintController::class, 'getByTicket']);
Route::get('/complaints/resolved', [ComplaintController::class, 'getResolved']);
Route::get('/complaints/statistics', [ComplaintController::class, 'getStatistics']);
// Get resolved complaints (public)
Route::get('/complaints/resolved', [ComplaintController::class, 'resolved']);

// Auth Routes
Route::post('/login', [AuthController::class, 'login']);

// Admin API Routes (with authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Admin Complaint Management
    Route::get('/admin/complaints', [ComplaintController::class, 'index']);
    Route::get('/admin/complaints/{id}', [ComplaintController::class, 'show']);
    Route::put('/admin/complaints/{id}', [ComplaintController::class, 'update']);
});
