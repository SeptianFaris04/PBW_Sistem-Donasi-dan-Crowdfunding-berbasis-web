<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrunDanaController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\RoleManagementController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware('guest')->group(function(){
    Route::get('/', HomeController::class)->name('home');
    Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/{donasi:slug_donasis}', [DonasiController::class, 'show'])->name('donasi.show');
    // Route::get('/donasi/komentar/{donasi}', [PaymentController::class, 'indexdonasi'])->name('donasi.komentar');
    Route::get('/urundana', [UrunDanaController::class, 'index'])->name('urundana.index');
    // Route::get('/urundana/komentar/{urundana:slug_urundanas}', [PaymentController::class, 'viewurundana'])->name('payment.viewurundana');
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

        if('permission:buat-pemberian-donasi'){
            // Route untuk menampilkan form donasi
            Route::get('/payment/donasi/create/{donasi}', [PaymentController::class, 'createdonasi'])->name('payment.donasi.create');

            // Route untuk proses penyimpanan donasi
            Route::post('/payment/donasi/create/{donasi}', [PaymentController::class, 'storedonasi'])->name('payment.storedonasi');

            // Route untuk menampilkan hasil donasi
            Route::get('/payment/donasi/check/{donasi}/{payment}', [PaymentController::class, 'checkdonasi'])->name('payment.donasi.check');
        }

        if('permission:buat-pemberian-urundana'){
            // Route untuk menampilkan form donasi
            Route::get('/payment/urundana/create/{urundana}', [PaymentController::class, 'createurundana'])->name('payment.urundana.create');

            // Route untuk proses penyimpanan donasi
            Route::post('/payment/urundana/create/{urundana}', [PaymentController::class, 'storeurundana'])->name('payment.storeurundana');

            // Route untuk menampilkan hasil donasi
            Route::get('/payment/urundana/check/{urundana}/{payment}', [PaymentController::class, 'checkurundana'])->name('payment.urundana.check');
        }
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

    if('permission:hapus-urundana'){
        Route::delete('/urundana/{urundana}', [UrunDanaController::class, 'destroy'])->name('urundana.destroy');
    }

    Route::get('/role-management', [RoleManagementController::class, 'index'])->name('role-management.index');
    Route::put('/role-management/update-role/{user}', [RoleManagementController::class, 'updateRole'])->name('role-management.update-role');
    Route::post('/role-management/add-permission/{user}', [RoleManagementController::class, 'addPermission'])->name('role-management.add-permission');
    Route::delete('/role-management/remove-permission/{user}', [RoleManagementController::class, 'removePermission'])->name('role-management.remove-permission');

    // if('permission:tambah-merchandise'){
    //     Route::get('/merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create');
    //     Route::post('/merchandise', [MerchandiseController::class, 'store'])->name('merchandise.store');
    // }
    // Route::get('/donasi/edit/{urundana:slug_urundanas}', [DonasiController::class, 'index'])->name('urundana');

    Route::get('/merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create');
});


require __DIR__.'/auth.php';
