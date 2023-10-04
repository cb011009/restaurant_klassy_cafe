<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* User Reservation Route
Route::get('/reservation', [App\Http\Controllers\UserController::class, 'reservation'])->name('reservation');*/
Route::get('/reservation', [App\Http\Controllers\ReservationController::class, 'reservation'])->name('reservation');
Route::post('/reservation', [App\Http\Controllers\ReservationController::class, 'storeReservation'])->name('reservation_store');
Route::get('/waiter_panel', [App\Http\Controllers\WaiterController::class, 'waiter_reservation_list'])->name('waiter_panel');
Route::post('/waiter_panel', [App\Http\Controllers\WaiterController::class, 'filterReservations'])->name('waiter_filter');




// Admin Dashboard Route
Route::get('/admin_panel', [App\Http\Controllers\AdminController::class, 'manageUsers'])->name('admin_panel');

//newly added for staff roles

Route::get('/waiter_panel', [App\Http\Controllers\WaiterController::class, 'waiter_panel'])->name('waiter_panel');
Route::get('/chef_panel', [App\Http\Controllers\ChefController::class, 'chef_panel'])->name('chef_panel');



//newly added

// Edit User
Route::get('/admin_edit_user/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin_edit_user');

// Update User (PUT request)
Route::put('/admin_update_user/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin_update_user');

// Delete User (DELETE request)
Route::delete('/admin_delete_user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin_delete_user');



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware(['auth', 'verified']);