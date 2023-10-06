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



Route::post('/reservations/{id}', [App\Http\Controllers\ReservationController::class, 'cancelReservation'])->name('cancel_reservation');




Route::get('/waiter_panel', [App\Http\Controllers\WaiterController::class, 'waiter_reservation_list'])->name('waiter_panel');
Route::post('/waiter_panel', [App\Http\Controllers\WaiterController::class, 'filterReservations'])->name('waiter_filter');


//newly added 

Route::get('/create_order/{id}', [App\Http\Controllers\WaiterController::class, 'createOrder'])->name('create_order');
Route::post('/create_order/{id}',[App\Http\Controllers\WaiterController::class, 'storeOrder'])->name('store_order');







// Admin Dashboard Route
Route::get('/admin_panel', [App\Http\Controllers\AdminController::class, 'manageUsers'])->name('admin_panel');

//newly added for staff roles

Route::get('/waiter_panel', [App\Http\Controllers\WaiterController::class, 'waiter_panel'])->name('waiter_panel');
Route::patch('/waiter_panel/{id}', [App\Http\Controllers\WaiterController::class, 'markAsdone'])->name('mark_reservation_as_done');
Route::get('/waiter_edit_table/{id}', [App\Http\Controllers\WaiterController::class, 'editTable'])->name('edit_table');
Route::patch('/waiter_edit_table/{id}', [App\Http\Controllers\WaiterController::class, 'updateTable'])->name('update_table');



Route::get('/chef_panel', [App\Http\Controllers\ChefController::class, 'chef_panel'])->name('chef_panel');
Route::patch('/chef_panel/{id}', [App\Http\Controllers\ChefController::class, 'markOrderDone'])->name('chef_mark_order_done');



//newly added

// Edit User
Route::get('/admin_edit_user/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin_edit_user');

// Update User (PUT request)
Route::put('/admin_update_user/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin_update_user');

// Delete User (DELETE request)
Route::delete('/admin_delete_user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin_delete_user');


Route::get('/admin_analytics', [ App\Http\Controllers\AnalyticsController::class, 'showAnalytics'])->name('admin_analytics');


//newly added for manage products by admin


Route::get('/admin_create_product', [ App\Http\Controllers\AdminController::class, 'createProductPage'])->name('admin_create_product');
Route::post('/admin_add_product', [ App\Http\Controllers\AdminController::class, 'addProduct'])->name('admin_add_product');
Route::post('/admin_create_category', [ App\Http\Controllers\AdminController::class, 'addCategory'])->name('admin_create_category');
Route::get('/admin_delete{id}', [ App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('delete_product');
Route::post('/admin_fliter', [ App\Http\Controllers\AdminController::class, 'filterProducts'])->name('admin_filter');






///


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