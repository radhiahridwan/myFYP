<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminApiController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes handle API requests for admin dashboard and student management.
|
*/

// Authenticated user info (default)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ===================== ADMIN DASHBOARD APIs ===================== //
Route::get('/admin/metrics', [AdminApiController::class, 'metrics']);
Route::get('/admin/recent-students', [AdminApiController::class, 'recentStudents']);
Route::get('/admin/recent-forms', [AdminApiController::class, 'recentForms']);

// ===================== STUDENT MANAGEMENT APIs ===================== //
Route::get('/students', [StudentController::class, 'index']);          // Get all students
Route::get('/students/{id}', [StudentController::class, 'show']);      // View single student
Route::post('/students', [StudentController::class, 'store']);         // Add new student
Route::put('/students/{id}', [StudentController::class, 'update']);    // Update student
Route::delete('/students/{id}', [StudentController::class, 'destroy']); // Delete student
