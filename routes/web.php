<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\LeaveRequestsController;

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
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('admin')->name('admin.')->middleware('user_type', 'verified')->group(function () {

        Route::resource('employees', EmployeeController::class);
        Route::resource('leavetypes', LeaveTypeController::class);

        Route::get('/leave-requests', [LeaveRequestController::class, 'adminViewLeaveRequests'])->name('leave-requests.view');
        Route::post('/leave-requests/approve/{request}', [LeaveRequestController::class, 'approveLeaveRequest'])->name('leave-requests.approve');
        Route::post('/leave-requests/deny/{request}', [LeaveRequestController::class, 'denyLeaveRequest'])->name('leave-requests.deny');
    });
    Route::get('show-leaves', [EmployeeLeaveController::class, 'showLeaves'])->name('show-leaves');
    Route::get('create-order/{id}', [EmployeeLeaveController::class, 'create'])->name('create');

    Route::post('/leave-request', [LeaveRequestController::class, 'submitLeaveRequest'])->name('leave-request.submit');
    Route::get('/leave-requests', [LeaveRequestController::class, 'viewLeaveRequestStatus'])->name('leave-requests.view');
    Route::delete('/leave-requests/{id}', [EmployeeLeaveController::class, 'destroy'])->name('leave-requests.destroy');
});

require __DIR__ . '/auth.php';



Route::view('no-access', 'no-access');
