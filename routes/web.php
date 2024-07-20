<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dudi\DudiPklController;
use App\Http\Controllers\Guru\GuruPklController;
use App\Http\Controllers\Staff\StaffCpController;
use App\Http\Controllers\Dudi\DudiNilaiController;
use App\Http\Controllers\Guru\GuruNilaiController;
use App\Http\Controllers\Siswa\SiswaPklController;
use App\Http\Controllers\Staff\StaffPklController;
use App\Http\Controllers\Staff\StaffDudiController;
use App\Http\Controllers\Staff\StaffGuruController;
use App\Http\Controllers\Dudi\DudiProfileController;
use App\Http\Controllers\Guru\GuruProfileController;
use App\Http\Controllers\Staff\StaffKelasController;
use App\Http\Controllers\Staff\StaffSiswaController;
use App\Http\Controllers\Dudi\DudiDashboardController;
use App\Http\Controllers\Dudi\DudiNilaiDudiController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\Siswa\SiswaProfileController;
use App\Http\Controllers\Staff\StaffJurusanController;
use App\Http\Controllers\Staff\StaffProfileController;
use App\Http\Controllers\Siswa\SiswaDashboardController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Guru\GuruLaporanAkhirController;
use App\Http\Controllers\Staff\StaffPengaturanController;
use App\Http\Controllers\Dudi\DudiLaporanHarianController;
use App\Http\Controllers\Dudi\DudiLaporanProyekController;
use App\Http\Controllers\Guru\GuruLaporanHarianController;
use App\Http\Controllers\Guru\GuruLaporanProyekController;
use App\Http\Controllers\Siswa\SiswaLaporanAkhirController;
use App\Http\Controllers\Siswa\SiswaLaporanHarianController;
use App\Http\Controllers\Siswa\SiswaLaporanProyekController;

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
    return redirect('/login');;
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('staff')->middleware(['checkRole:admin'])->group(function () {
        Route::get('/', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
        Route::match(['get', 'post'], '/profile', [StaffProfileController::class, 'index'])->name('staff.profile');
        Route::put('/profile/password', [StaffProfileController::class, 'updatePassword'])->name('staff.updatePassword');
        Route::resource('/jurusan', StaffJurusanController::class)->names('staff.jurusan');
        Route::resource('/kelas', StaffKelasController::class)->names('staff.kelas');
        Route::resource('/cp', StaffCpController::class)->names('staff.cp');
        Route::resource('/guru', StaffGuruController::class)->names('staff.guru');
        Route::resource('/siswa', StaffSiswaController::class)->names('staff.siswa');
        Route::resource('/dudi', StaffDudiController::class)->names('staff.dudi');
        Route::resource('/pkl', StaffPklController::class)->names('staff.pkl');
        Route::match(['get', 'post'], '/pengaturan', [StaffPengaturanController::class, 'index'])->name('staff.pengaturan');
    });

    Route::prefix('guru')->middleware(['checkRole:guru_pembimbing'])->group(function () {
        Route::resource('/pkl', GuruPklController::class)->names('guru.pkl');
        Route::get('/', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
        Route::get('/laporan-harian', [GuruLaporanHarianController::class, 'index'])->name('guru.laporanHarian');
        Route::resource('/laporan-proyek', GuruLaporanProyekController::class)->names('guru.laporanProyek');
        Route::resource('/laporan-akhir', GuruLaporanAkhirController::class)->names('guru.laporanAkhir');
        Route::match(['get', 'post'], '/profile', [GuruProfileController::class, 'index'])->name('guru.profile');
        Route::put('/profile/password', [GuruProfileController::class, 'updatePassword'])->name('guru.updatePassword');
        Route::post('/nilai', [GuruNilaiController::class, 'store'])->name('guru.nilai');
    });

});

Route::middleware('auth:dudi')->prefix('dudi')->group(function () {
    Route::get('/', [DudiDashboardController::class, 'index'])->name('dudi.dashboard');
    Route::resource('/laporan-harian', DudiLaporanHarianController::class)->names('dudi.laporanHarian');
    Route::resource('/laporan-proyek', DudiLaporanProyekController::class)->names('dudi.laporanProyek');
    Route::match(['get', 'post'], '/profile', [DudiProfileController::class, 'index'])->name('dudi.profile');
    Route::put('/profile/password', [DudiProfileController::class, 'updatePassword'])->name('dudi.updatePassword');
    Route::resource('/pkl', DudiPklController::class)->names('dudi.pkl');
    Route::post('/nilai', [DudiNilaiController::class, 'store'])->name('dudi.nilai');
});

Route::middleware('auth:siswa')->prefix('siswa')->group(function () {
    Route::resource('/pkl', SiswaPklController::class)->names('siswa.pkl');
    Route::resource('/laporan-proyek', SiswaLaporanProyekController::class)->names('siswa.laporanProyek');
    Route::resource('/laporan-harian', SiswaLaporanHarianController::class)->names('siswa.laporanHarian');
    Route::get('/', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    Route::match(['get', 'post'], '/profile', [SiswaProfileController::class, 'index'])->name('siswa.profile');
    Route::match(['get', 'post'], '/laporan-akhir', [SiswaLaporanAkhirController::class, 'index'])->name('siswa.laporanAkhir');
    Route::put('/profile/password', [SiswaProfileController::class, 'updatePassword'])->name('siswa.updatePassword');
});

Route::middleware(['guest'])->group(function () {
    Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
    Route::match(['get', 'post'], '/register', [AuthController::class, 'register']);
});
