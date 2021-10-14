<?php

use Illuminate\Support\Facades\Route;

//
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CooperativeEstablishmentController;

//
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\CooperativeEstablishmentController as AdminCooperativeEstablishmentController;
use App\Http\Controllers\Admin\AdvocacyController as AdminAdvocacyController;

//
use App\Http\Controllers\Cooperative\FormController as CooperativeFormController;
use App\Http\Controllers\Cooperative\AdvocacyController as CooperativeAdvocacyController;

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

// HOME
Route::get('/', function () { return view('welcome'); })->name('home');

// Authentication
require __DIR__.'/auth.php';
Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth:web,cooperative'])->name('dashboard');

/**
 * PUBLIC ROUTES
 */
// Registration
Route::get('/registrasi', [RegisterController::class, 'index'])->name('registration');
Route::get('/registrasi/success', [RegisterController::class, 'success'])->name('registration.success');
Route::post('/registrasi', [RegisterController::class, 'store'])->name('registration.store');
// Pendirian Koperasi - CooperativeEstablishment
Route::get('/pendirian-koperasi', [CooperativeEstablishmentController::class, 'index'])->name('cooperative.establishment');
Route::post('/pendirian-koperasi', [CooperativeEstablishmentController::class, 'store'])->name('cooperative.establishment.store');


/**
 * ADMIN ROUTES
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth:web']
], function () {
    // register
    Route::get('/registrasi', [AdminRegisterController::class, 'index'])->name('registration');
    Route::get('/registrasi/{cooperative}', [AdminRegisterController::class, 'show'])->name('registration.show');
    Route::put('/registrasi/{cooperative}', [AdminRegisterController::class, 'update'])->name('registration.update');

    //
    Route::get('/pendirian-koperasi', [AdminCooperativeEstablishmentController::class, 'index'])->name('cooperative.establishment');
    Route::get('/pendirian-koperasi/{id}/action', [AdminCooperativeEstablishmentController::class, 'action'])->name('cooperative.establishment.action');
    Route::get('/pendirian-koperasi/terkonfirmasi/{id}', [AdminCooperativeEstablishmentController::class, 'confirm_show'])->name('cooperative.establishment.confirm_show');
    Route::put('/pendirian-koperasi/terkonfirmasi/{id}', [AdminCooperativeEstablishmentController::class, 'confirm_update'])->name('cooperative.establishment.confirm_update');

    //
    Route::get('/advokasi', [AdminAdvocacyController::class, 'index'])->name('cooperative.advocacy');
    Route::get('/advokasi/{id}/action', [AdminAdvocacyController::class, 'action'])->name('cooperative.advocacy.action');
    Route::get('/advokasi/terkonfirmasi/{id}', [AdminAdvocacyController::class, 'confirm_show'])->name('cooperative.advocacy.confirm_show');
    Route::put('/advokasi/terkonfirmasi/{id}', [AdminAdvocacyController::class, 'confirm_update'])->name('cooperative.advocacy.confirm_update');
});


/**
 * COOPERATIVE ROUTES
 */
Route::group([
    'prefix' => 'cooperative',
    'as' => 'cooperative.',
    'middleware' => ['auth:cooperative']
], function () {
    // update form
    Route::get('/form/edit', [CooperativeFormController::class, 'edit'])->name('form.edit');
    Route::put('/form/edit', [CooperativeFormController::class, 'update'])->name('form.update');
    // advokasi
    Route::get('/advokasi', [CooperativeAdvocacyController::class, 'index'])->name('advocacy');
    Route::post('/advokasi', [CooperativeAdvocacyController::class, 'store'])->name('advocacy.store');
});
