<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('role:RoleAdmin,RoleMaster')->name('dashboard');

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

require __DIR__.'/auth.php';
