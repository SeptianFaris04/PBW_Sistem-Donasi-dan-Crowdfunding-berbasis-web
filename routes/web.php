<?php

use App\Http\Controllers\DonasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrunDanaController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware('guest')->group(function(){
    Route::get('/', HomeController::class)->name('home');
    Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::get('/urundana', [UrunDanaController::class, 'index'])->name('urundana.index');
    Route::get('/merchandise', [MerchandiseController::class, 'index'])->name('merchandise.index');
// });

Route::middleware(['auth', 'role:user|admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::middleware('verified')->group(function () {
        
        if('permission:edit-profile'){
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        }

        if('permission:hapus-akun'){
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');   
        }

        // if('permission:ta')
    });
});
    

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    if('permission:tambah-donasi'){
        Route::get('/donasi/create', [DonasiController::class, 'create'])->name('donasi.create');
        Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
    }

    if('permission:edit-donasi'){
        Route::get('/donasi/{donasi:slug_donasis}/edit', [DonasiController::class, 'edit'])->name('donasi.edit');
        Route::put('/donasi/{donasi}', [DonasiController::class, 'update'])->name('donasi.update');
    }

    if('permission:hapus-donasi'){
        Route::delete('/donasi/{donasi}', [DonasiController::class, 'destroy'])->name('donasi.destroy');
    }

    if('permission:tambah-urundana'){
        Route::get('/urundana/create', [UrunDanaController::class, 'create'])->name('urundana.create');
        Route::post('/urundana', [UrunDanaController::class, 'store'])->name('urundana.store');
    }

    if('permission:edit-urundana'){
        Route::get('/urundana/{urundana:slug_urundana}/edit', [UrunDanaController::class, 'edit'])->name('urundana.edit');
        Route::put('/urundana/{urundana}', [UrunDanaController::class, 'update'])->name('urundana.update');
    }

    if('permission:tambah-merchandise'){
        Route::get('/merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create');
        Route::post('/merchandise', [MerchandiseController::class, 'store'])->name('merchandise.store');
    }
    // Route::get('/donasi/edit/{urundana:slug_urundanas}', [DonasiController::class, 'index'])->name('urundana');

    // Route::get('/merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create');
});


require __DIR__.'/auth.php';
