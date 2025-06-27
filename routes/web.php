<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\VehicleUsageController;
use App\Http\Controllers\VehicleServiceController;
use App\Http\Controllers\BookingLogController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\KendaraanServiceController;
use App\Http\Controllers\KendaraanUsageController;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Role Management
Route::resource('roles', RoleController::class);

// Semua route di bawah hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    // User Management
    Route::resource('users', UserController::class);
    Route::get('/data-users/export', [UserController::class, 'export'])->name('users.export');

    // Data Kendaraan
    Route::resource('kendaraans', KendaraanController::class)->middleware('auth');;
    Route::get('/data-vehicles/export', [KendaraanController::class, 'export'])->name('vehicles.export');
    Route::post('/data-vehicles/import', [KendaraanController::class, 'import'])->name('vehicles.import');

    // Data Driver
    Route::resource('drivers', DriverController::class);
    Route::get('/data-drivers/export', [DriverController::class, 'export'])->name('drivers.export');
    Route::post('/data-drivers/import', [DriverController::class, 'import'])->name('drivers.import');

    // Data Lokasi/Region
    Route::resource('regions', RegionController::class)->middleware('auth');
    Route::get('/data-regions/export', [RegionController::class, 'export'])->name('regions.export');
    Route::post('/data-regions/import', [RegionController::class, 'import'])->name('regions.import');

    // Pemesanan Kendaraan
    Route::resource('bookings', BookingController::class)->middleware('auth');
    Route::get('/data-bookings/export', [BookingController::class, 'export'])->name('bookings.export');
    Route::post('/data-bookings/import', [BookingController::class, 'import'])->name('bookings.import');

    // Approval Pemesanan (Persetujuan Berjenjang)
    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::post('/approvals/{booking}/approve', [ApprovalController::class, 'approve'])->name('approvals.approve');
    Route::post('/approvals/{booking}/reject', [ApprovalController::class, 'reject'])->name('approvals.reject');

    // Riwayat Pemakaian Kendaraan
    Route::resource('vehicle_usage', KendaraanUsageController::class)->only(['index', 'show', 'create', 'store']);
    Route::get('/data-vehicle-usage/export', [KendaraanUsageController::class, 'export'])->name('vehicle_usage.export');

    // Jadwal & Riwayat Service Kendaraan
    Route::resource('vehicle_service', KendaraanServiceController::class)->only(['index', 'show', 'create', 'store']);
    Route::get('/data-vehicle-service/export', [KendaraanServiceController::class, 'export'])->name('vehicle_service.export');

    Route::patch('booking-approvement/{booking}/approve', [ApprovalController::class, 'approve'])->name('bookings.approve')->middleware('auth');
    Route::patch('booking-approvement/{booking}/reject', [ApprovalController::class, 'reject'])->name('bookings.reject')->middleware('auth');
    Route::patch('bookings/{booking}/finish', [BookingController::class, 'finish'])->name('bookings.finish')->middleware('auth');
    Route::get('/log-audit', [AuditController::class, 'index'])->name('log');

    Route::get('/laporan-pemesanan', [HomeController::class, 'laporan'])->name('laporan.index');
    Route::get('/laporan/export', [HomeController::class, 'exportExcel'])->name('laporan.export');
});
