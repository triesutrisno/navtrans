<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PropinsiController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\ArmadaController;
use App\Http\Controllers\SupirController;

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:RoleAdmin,RoleMaster'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware(['auth', 'role:RoleAdmin,RoleMaster'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});

//setting route bertingkat
Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth', 'role:RoleAdmin'])->group(function () {
        Route::get('/menu', [MenuController::class, 'index']);
        Route::get('/menu/create', [MenuController::class, 'create']);
        Route::post('/menu/store', [MenuController::class, 'store']);
        Route::get('/menu/edit/{id}', [MenuController::class, 'edit']);
        Route::post('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::get('/menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth', 'role:RoleAdmin'])->group(function () {
        Route::get('/mrole', [RoleController::class, 'index']);
        Route::get('/mrole/create', [RoleController::class, 'create']);
        Route::post('/mrole/store', [RoleController::class, 'store']);
        Route::get('/mrole/edit/{id}', [RoleController::class, 'edit']);
        Route::post('/mrole/update/{id}', [RoleController::class, 'update'])->name('mrole.update');
        Route::get('/mrole/delete/{id}', [RoleController::class, 'destroy'])->name('mrole.delete');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth', 'role:RoleAdmin,RoleMaster'])->group(function () {
        Route::get('/propinsi', [PropinsiController::class, 'index']);
        Route::get('/propinsi/create', [PropinsiController::class, 'create']);
        Route::post('/propinsi/store', [PropinsiController::class, 'store']);
        Route::get('/propinsi/edit/{id}', [PropinsiController::class, 'edit']);
        Route::post('/propinsi/update/{id}', [PropinsiController::class, 'update'])->name('propinsi.update');
        Route::get('/propinsi/delete/{id}', [PropinsiController::class, 'destroy'])->name('propinsi.delete');

        Route::get('/kota', [KotaController::class, 'index']);
        Route::get('/kota/create', [KotaController::class, 'create']);
        Route::post('/kota/store', [KotaController::class, 'store']);
        Route::get('/kota/edit/{id}', [KotaController::class, 'edit']);
        Route::post('/kota/update/{id}', [KotaController::class, 'update'])->name('kota.update');
        Route::get('/kota/delete/{id}', [KotaController::class, 'destroy'])->name('kota.delete');

        // Kecamatan Routes
        Route::get('/kecamatan', [KecamatanController::class, 'index']);
        Route::get('/kecamatan/create', [KecamatanController::class, 'create']);
        Route::post('/kecamatan/store', [KecamatanController::class, 'store']);
        Route::get('/kecamatan/edit/{id}', [KecamatanController::class, 'edit']);
        Route::post('/kecamatan/update/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
        Route::get('/kecamatan/delete/{id}', [KecamatanController::class, 'destroy'])->name('kecamatan.delete');

        // Lokasi Routes
        Route::get('/lokasi', [LokasiController::class, 'index']);
        Route::get('/lokasi/create', [LokasiController::class, 'create']);
        Route::post('/lokasi/store', [LokasiController::class, 'store']);
        Route::get('/lokasi/edit/{id}', [LokasiController::class, 'edit']);
        Route::post('/lokasi/update/{id}', [LokasiController::class, 'update'])->name('lokasi.update');
        Route::get('/lokasi/delete/{id}', [LokasiController::class, 'destroy'])->name('lokasi.delete');

        // Customer Routes
        Route::get('/customer', [CustomerController::class, 'index']);
        Route::get('/customer/create', [CustomerController::class, 'create']);
        Route::post('/customer/store', [CustomerController::class, 'store']);
        Route::get('/customer/edit/{id}', [CustomerController::class, 'edit']);
        Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::get('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');

        // Transporter (Vendor) Routes
        Route::get('/vendor', [TransporterController::class, 'index']);
        Route::get('/vendor/create', [TransporterController::class, 'create']);
        Route::post('/vendor/store', [TransporterController::class, 'store']);
        Route::get('/vendor/edit/{id}', [TransporterController::class, 'edit']);
        Route::post('/vendor/update/{id}', [TransporterController::class, 'update'])->name('vendor.update');
        Route::get('/vendor/delete/{id}', [TransporterController::class, 'destroy'])->name('vendor.delete');

        // Armada Routes
        Route::get('/armada', [ArmadaController::class, 'index']);
        Route::get('/armada/create', [ArmadaController::class, 'create']);
        Route::post('/armada/store', [ArmadaController::class, 'store']);
        Route::get('/armada/edit/{id}', [ArmadaController::class, 'edit']);
        Route::post('/armada/update/{id}', [ArmadaController::class, 'update'])->name('armada.update');
        Route::get('/armada/delete/{id}', [ArmadaController::class, 'destroy'])->name('armada.delete');

        // Supir (Driver) Routes
        Route::get('/supir', [SupirController::class, 'index']);
        Route::get('/supir/create', [SupirController::class, 'create']);
        Route::post('/supir/store', [SupirController::class, 'store']);
        Route::get('/supir/edit/{id}', [SupirController::class, 'edit']);
        Route::post('/supir/update/{id}', [SupirController::class, 'update'])->name('supir.update');
        Route::get('/supir/delete/{id}', [SupirController::class, 'destroy'])->name('supir.delete');
    });
});

require __DIR__ . '/auth.php';
