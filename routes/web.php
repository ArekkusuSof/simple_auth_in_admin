<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/login', [SessionController::class, 'index'])->name('login');

Route::post('/login', [SessionController::class, 'create'])->name('login');

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::get('/admin/{table?}', [AdminPanelController::class, 'index'])->name('admin');

Route::get('/admin-panel/{table}/{id}/edit', [AdminPanelController::class, 'edit'])->name('admin.edit');

Route::put('/admin-panel/{table}/{id}', [AdminPanelController::class, 'update'])->name('admin.update');

Route::delete('/admin-panel/{table}/{id}', [AdminPanelController::class, 'destroy'])->name('admin.destroy');
