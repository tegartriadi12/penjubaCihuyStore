<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DashboardController;

// =====================================
// AUTH
// =====================================
Route::get('/', fn() => view('auth.login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =====================================
// ADMIN
// =====================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('/products', ProductsController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/units', UnitController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/users', UserController::class);
    Route::resource('purchases', PurchaseController::class);
      Route::get('purchases/print/{id}',
        [\App\Http\Controllers\Admin\PurchaseController::class, 'print']
    )->name('purchases.print');
    Route::resource('returns', ReturnController::class);
    Route::get('returns/{return}/print', [ReturnController::class, 'print'])->name('returns.print');



    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
});


// =====================================
// OWNER
// =====================================
// Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {

//     Route::get('/dashboard', [DashboardController::class, 'owner'])->name('owner.dashboard');

//     Route::get('/reports', [ReportController::class, 'owner'])->name('owner.reports');
//     Route::get('/purchases', [PurchaseController::class, 'index'])->name('owner.purchases');
// });


// // =====================================
// // KASIR
// // =====================================
// Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {

//     Route::get('/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');

//     Route::get('/pos', [KasirController::class, 'index'])->name('kasir.pos');
//     Route::resource('/transactions', TransactionController::class);

//     Route::get('/shift/close', [ShiftController::class, 'close'])->name('kasir.shift.close');
//     Route::get('/return', [ReturnController::class, 'index'])->name('kasir.return');
// });


// // =====================================
// // GUDANG
// // =====================================
// Route::middleware(['auth', 'role:gudang'])->prefix('gudang')->group(function () {

//     Route::get('/dashboard', [DashboardController::class, 'gudang'])->name('gudang.dashboard');

//     Route::get('/stock', [StockController::class, 'index'])->name('gudang.stock');
//     Route::get('/stock/in', [StockInController::class, 'index'])->name('gudang.stock.in');
//     Route::get('/stock/out', [StockOutController::class, 'index'])->name('gudang.stock.out');
//     Route::get('/stock/mutation', [StockMutationController::class,'index'])->name('gudang.stock.mutation');
//     Route::get('/stock/opname', [StockOpnameController::class,'index'])->name('gudang.stock.opname');
// });
