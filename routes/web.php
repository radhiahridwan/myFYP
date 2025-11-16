<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminApiController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentOutingController; 
use App\Http\Controllers\AdminOutingController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\NotificationController;


// ======================
// ROOT REDIRECT
// ======================
Route::get('/', function () {
    return redirect()->route('login');
});

// ======================
// AUTHENTICATION ROUTES
// ======================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('signup.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ======================
// DASHBOARD & AUTH ROUTES
// ======================
Route::middleware(['auth'])->group(function () {

    // ======================
    // ADMIN ROUTES
    // ======================
    Route::prefix('admin')->middleware(['is_admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
       

        // Profile
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

        // Student Management
        Route::get('/students', [AdminStudentController::class, 'index'])->name('admin.students');
        Route::get('/api/students', [AdminStudentController::class, 'fetchAll']);
        Route::put('/api/students/{id}', [AdminStudentController::class, 'update']);
        Route::delete('/api/students/{id}', [AdminStudentController::class, 'destroy']);
        Route::get('/students/export/pdf', [AdminStudentController::class, 'exportPDF']);

        // Rooms & Houses
        Route::get('/houses', [AdminRoomController::class, 'index'])->name('admin.rooms');
        Route::get('/get-rooms/{level}', [AdminRoomController::class, 'getRooms']);
        Route::get('/get-students/{roomId}', [AdminRoomController::class, 'getStudents']);
        Route::post('/api/add-student', [AdminRoomController::class, 'addStudent']);
        Route::post('/api/assign-student', [AdminRoomController::class, 'assignStudent']); 
        Route::get('/students-without-rooms', [AdminRoomController::class, 'getStudentsWithoutRooms']);
        Route::delete('/students/{studentId}/remove-room', [AdminRoomController::class, 'removeStudentFromRoom']);

        // Forms Management
        Route::get('/forms', [FormController::class, 'adminIndex'])->name('admin.forms');
        Route::get('/forms/{id}', [FormController::class, 'showForm'])->name('admin.forms.show');
        Route::post('/forms/{id}/status', [FormController::class, 'updateStatus'])->name('admin.forms.update-status');
        Route::post('/forms/{id}/comment', [FormController::class, 'addComment'])->name('admin.forms.add-comment');
        Route::get('/forms/{id}/export-pdf', [FormController::class, 'exportPDF'])->name('admin.forms.export-pdf');
        Route::delete('/forms/{form}', [FormController::class, 'destroy'])->name('admin.forms.destroy');

        // Rules 
        Route::get('/rules', [AdminController::class, 'rules'])->name('admin.rules');
        Route::post('/rules', [AdminController::class, 'storeRule'])->name('admin.rules.store');
        Route::get('/rules/edit/{id}', [AdminController::class, 'editRule'])->name('admin.rules.edit');
        Route::post('/rules/update/{id}', [AdminController::class, 'updateRule'])->name('admin.rules.update');
        Route::delete('/rules/delete/{id}', [AdminController::class, 'deleteRule'])->name('admin.rules.delete');

        // Payments
        Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments');        Route::patch('/payments/{id}', [PaymentController::class, 'updateStatus'])->name('admin.payments.update');
        Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('admin.payments.destroy');
        Route::get('/payments/{id}/receipt', [PaymentController::class, 'viewReceipt'])->name('admin.payments.receipt');
        Route::get('/payments/{id}/download', [PaymentController::class, 'downloadReceipt'])->name('admin.payments.download');
        Route::get('/payments/data', [PaymentController::class, 'getPaymentsData'])->name('admin.payments.data');

        // Outing
        Route::get('/outings', [AdminOutingController::class, 'index'])->name('admin.outings');
        Route::post('/outings/{id}/mark-returned', [AdminOutingController::class, 'markReturned'])->name('admin.outings.mark-returned');
        Route::get('/outings/export/excel', [AdminOutingController::class, 'exportExcel'])->name('admin.outings.export.excel');
        Route::get('/outings/export/pdf', [AdminOutingController::class, 'exportPDF'])->name('admin.outings.export.pdf');

        // API Data
        Route::get('/api/metrics', [AdminApiController::class, 'metrics']);
        Route::get('/api/recent-students', [AdminApiController::class, 'recentStudents']);
        Route::get('/api/recent-forms', [AdminApiController::class, 'recentForms']);
        Route::get('/api/dashboard/outings', [AdminController::class, 'dashboardOutings']);
        Route::get('/api/dashboard/forms', [AdminController::class, 'dashboardForms']);

        // Add this route in your admin routes
        Route::put('/api/room-students/{id}', [AdminRoomController::class, 'updateStudentInRoom']);

        // Settings Routes
        Route::get('/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
        Route::post('/settings/update-password', [AdminController::class, 'updatePassword'])->name('admin.settings.update-password');   
    });

    // ======================
    // STUDENT ROUTES
    // ======================
    Route::prefix('student')->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('students.dashboard');
        })->name('students.dashboard'); 

        // Rules 
        Route::get('/rules', [StudentController::class, 'rules'])->name('students.rules'); 

         // User Manual
        Route::get('/manual', [StudentController::class, 'manual'])->name('students.manual');


        // Payments
        Route::get('/payments', [PaymentController::class, 'studentIndex'])->name('students.payments'); 
        Route::post('/payments/upload', [PaymentController::class, 'uploadReceipt'])->name('students.payments.upload'); 

        // Profile
        Route::get('/profile', [StudentController::class, 'profile'])->name('students.profile');
        Route::post('/profile/update', [StudentController::class, 'updateProfile'])->name('students.profile.update');

        // Wardens
        Route::get('/wardens', [StudentController::class, 'wardens'])->name('students.wardens'); 

        // Student outing 
        Route::get('/outing/form', [StudentController::class, 'outingForm'])->name('outing.form');
        Route::get('/outing/current', [StudentController::class, 'currentOuting'])->name('outing.current');
        Route::get('/outing/history', [StudentController::class, 'outingHistory'])->name('outing.history');

        // Student outing ACTION routes
   
        Route::post('/outing/form', [StudentOutingController::class, 'store'])->name('outing.store');
        Route::post('/outing/{id}/return', [StudentOutingController::class, 'markReturned'])->name('outing.mark-returned');
        Route::delete('/outing/{id}', [StudentOutingController::class, 'destroy'])->name('outing.delete');
        Route::get('/outing/{id}/edit', [StudentOutingController::class, 'edit'])->name('outing.edit');
        Route::put('/outing/{id}', [StudentOutingController::class, 'update'])->name('outing.update');
        
        // Forms Routes
        Route::get('/forms', [FormController::class, 'index'])->name('student.forms');

          // Vehicle Sticker Application Routes
        Route::get('/forms/vehicle-sticker', [FormController::class, 'showVehicleStickerForm'])->name('forms.vehicle-sticker.create');
        Route::post('/forms/vehicle-sticker', [FormController::class, 'storeVehicleSticker'])->name('forms.vehicle-sticker.store');
        Route::get('/forms/vehicle-sticker/{id}', [FormController::class, 'showVehicleSticker'])->name('forms.vehicle-sticker.show');
        Route::post('/forms/vehicle-sticker/{id}/comment', [FormController::class, 'addVehicleStickerComment'])->name('forms.vehicle-sticker.comment');

        // Facility Report Routes
        Route::get('/forms/facility-report', [FormController::class, 'showFacilityReportForm'])->name('forms.facility-report.create');
        Route::post('/forms/facility-report', [FormController::class, 'storeFacilityReport'])->name('forms.facility-report.store');
        Route::get('/forms/facility-report/{id}', [FormController::class, 'showFacilityReport'])->name('forms.facility-report.show');
        Route::post('/forms/facility-report/{id}/comment', [FormController::class, 'addFacilityReportComment'])->name('forms.facility-report.comment');

        // Change Room Request Routes
        Route::get('/forms/change-room', [FormController::class, 'showChangeRoomForm'])->name('forms.change-room.create');
        Route::post('/forms/change-room', [FormController::class, 'storeChangeRoom'])->name('forms.change-room.store');
        Route::get('/forms/change-room/{id}', [FormController::class, 'showChangeRoom'])->name('forms.change-room.show');
        Route::post('/forms/change-room/{id}/comment', [FormController::class, 'addChangeRoomComment'])->name('forms.change-room.comment');

        // Hostel Check-out Routes
        Route::get('/forms/check-out', [FormController::class, 'showCheckOutForm'])->name('forms.check-out.create');
        Route::post('/forms/check-out', [FormController::class, 'storeCheckOut'])->name('forms.check-out.store');
        Route::get('/forms/check-out/{id}', [FormController::class, 'showCheckOut'])->name('forms.check-out.show');
        Route::post('/forms/check-out/{id}/comment', [FormController::class, 'addCheckOutComment'])->name('forms.check-out.comment');

        // Add to student routes group
        Route::get('/settings', [StudentController::class, 'showSettings'])->name('students.settings');
        Route::post('/settings/update-password', [StudentController::class, 'updatePassword'])->name('students.settings.update-password');
    });


});