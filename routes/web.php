<?php

use Illuminate\Support\Facades\Route;

//
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CooperativeEstablishmentController;

//
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\CooperativeEstablishmentController as AdminCooperativeEstablishmentController;
use App\Http\Controllers\Admin\AdvocacyController as AdminAdvocacyController;
use App\Http\Controllers\Admin\AccompanimentController as AdminAccompanimentController;
use App\Http\Controllers\Admin\PenkesController as AdminPenkesController;
use App\Http\Controllers\Admin\EducationController as AdminEducationController;

//
use App\Http\Controllers\Cooperative\FormController as CooperativeFormController;
use App\Http\Controllers\Cooperative\AdvocacyController as CooperativeAdvocacyController;
use App\Http\Controllers\Cooperative\AccompanimentController as CooperativeAccompanimentController;
use App\Http\Controllers\Cooperative\PenkesController as CooperativePenkesController;
use App\Http\Controllers\Cooperative\EducationController as CooperativeEducationController;
use Illuminate\Support\Facades\Storage;

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
Route::get('/download', function () {
    $path = request()->get('path', null);
    if (!$path) return abort(404);
    return Storage::download($path);
})->name('download');

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
// PENDIDIKAN PERKOPERASIAN
Route::get('/pendidikan-perkoperasian', [CooperativeEducationController::class, 'index'])->name('cooperative.education');
Route::post('/pendidikan-perkoperasian', [CooperativeEducationController::class, 'store'])->name('cooperative.education.store');


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

    //
    Route::get('/pendampingan', [AdminAccompanimentController::class, 'index'])->name('cooperative.accompaniment');
    Route::get('/pendampingan/{id}/action', [AdminAccompanimentController::class, 'action'])->name('cooperative.accompaniment.action');
    Route::get('/pendampingan/terkonfirmasi/{id}', [AdminAccompanimentController::class, 'confirm_show'])->name('cooperative.accompaniment.confirm_show');
    Route::put('/pendampingan/terkonfirmasi/{id}', [AdminAccompanimentController::class, 'confirm_update'])->name('cooperative.accompaniment.confirm_update');

    //
    Route::get('/penkes', [AdminPenkesController::class, 'index'])->name('cooperative.penkes');
    Route::get('/penkes/{id}/action', [AdminPenkesController::class, 'action'])->name('cooperative.penkes.action');
    Route::get('/penkes/terkonfirmasi/{id}', [AdminPenkesController::class, 'confirm_show'])->name('cooperative.penkes.confirm_show');
    Route::put('/penkes/terkonfirmasi/{id}', [AdminPenkesController::class, 'confirm_update'])->name('cooperative.penkes.confirm_update');

    //
    Route::get('/pendidikan', [AdminEducationController::class, 'index'])->name('cooperative.education');
    Route::get('/pendidikan/{id}/action', [AdminEducationController::class, 'action'])->name('cooperative.education.action');
    Route::get('/pendidikan/terkonfirmasi/{id}', [AdminEducationController::class, 'confirm_show'])->name('cooperative.education.confirm_show');
    Route::put('/pendidikan/terkonfirmasi/{id}', [AdminEducationController::class, 'confirm_update'])->name('cooperative.education.confirm_update');
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
    // advokasi
    Route::get('/pendampingan', [CooperativeAccompanimentController::class, 'index'])->name('accompaniment');
    Route::post('/pendampingan', [CooperativeAccompanimentController::class, 'store'])->name('accompaniment.store');
    // penkes
    Route::get('/penkes', [CooperativePenkesController::class, 'index'])->name('penkes');
    Route::post('/penkes', [CooperativePenkesController::class, 'store'])->name('penkes.store');
});
