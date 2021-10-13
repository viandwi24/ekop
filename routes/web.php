<?php

use Illuminate\Support\Facades\Route;

//
use App\Http\Controllers\RegisterController;

//
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;

//
use App\Http\Controllers\Cooperative\FormController as CooperativeFormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth:web,cooperative'])->name('dashboard');

// Registration
Route::get('/registrasi', [RegisterController::class, 'index'])->name('registration');
Route::get('/registrasi/success', [RegisterController::class, 'success'])->name('registration.success');
Route::post('/registrasi', [RegisterController::class, 'store'])->name('registration.store');

// Authentication
require __DIR__.'/auth.php';

// Admin
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth:web']
], function () {
    Route::get('/registrasi', [AdminRegisterController::class, 'index'])->name('registration');
    Route::get('/registrasi/{cooperative}', [AdminRegisterController::class, 'show'])->name('registration.show');
    Route::put('/registrasi/{cooperative}', [AdminRegisterController::class, 'update'])->name('registration.update');
});


// Admin
Route::group([
    'prefix' => 'cooperative',
    'as' => 'cooperative.',
    'middleware' => ['auth:cooperative']
], function () {
    Route::get('/form/edit', [CooperativeFormController::class, 'edit'])->name('form.edit');
    Route::put('/form/edit', [CooperativeFormController::class, 'update'])->name('form.update');
});
