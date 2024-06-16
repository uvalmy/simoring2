<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Staff\StaffDudiController;
use App\Http\Controllers\Staff\StaffGuruController;
use App\Http\Controllers\Staff\StaffKelasController;
use App\Http\Controllers\Staff\StaffSiswaController;
use App\Http\Controllers\Staff\StaffJurusanController;
use App\Http\Controllers\Staff\StaffProfileController;
use App\Http\Controllers\Staff\StaffDashboardController;

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
    return view('pages.staff.dashboard.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('staff')->middleware(['checkRole:admin'])->group(function () {
        Route::match(['get', 'post'], '/profile', [StaffProfileController::class, 'index'])->name('staff.profile');
        Route::put('/profile/password', [StaffProfileController::class, 'updatePassword']);
        Route::get('/', [StaffDashboardController::class, 'index']);
        Route::resource('/jurusan', StaffJurusanController::class);
        Route::resource('/kelas', StaffKelasController::class);
        Route::resource('/guru', StaffGuruController::class);
        Route::resource('/siswa', StaffSiswaController::class);
        Route::resource('/dudi', StaffDudiController::class);
    });
});

Route::middleware(['guest'])->group(function () {
    Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
    Route::match(['get', 'post'], '/register', [AuthController::class, 'register']);
});


