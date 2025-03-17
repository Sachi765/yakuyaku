<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Events\MyEvent;

Route::get('/', function () {
    return redirect()->route('login'); 
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/errors/404', function () {
    return view('errors.404');
})->name('errors.404');

Route::get('/reservation/{id}',[ReservationController::class,'index'])->name('reservation.index');
Route::get('/qrcode/{id}',[QrController::class,'index'])->name('qrcode.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
    Route::get('/admin/create',[AdminController::class,'create'])->name('admin.create');
    Route::post('/admin/store',[AdminController::class,'store'])->name('admin.store');
    Route::post('/admin/update/{id}',[AdminController::class,'update'])->name('admin.update');
    Route::post('/admin/delete/{id}',[AdminController::class,'delete'])->name('admin.delete');
    Route::get('/user',[UserController::class,'index'])->name('user.index');
    Route::get('/user/create',[UserController::class,'create'])->name('user.create');
    Route::post('/user/store',[UserController::class,'store'])->name('user.store');
    Route::post('/user/status',[UserController::class,'statusUpdate'])->name('user.statusUpdate');
});

require __DIR__.'/auth.php';
