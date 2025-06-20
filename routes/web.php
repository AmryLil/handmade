<?php

use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KategoriAdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukUserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/produk/1', function () {
//     return view('pages/users/produk');
// });

Route::get('/kontak', function () {
    return view('pages/users/kontak');
})->name('kontak');
Route::get('/tentang', function () {
    return view('pages/users/about_us');
})->name('tentang');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home page
Route::get('/', [ProdukUserController::class, 'home'])->name('home');

Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{id}', [App\Http\Controllers\KategoriController::class, 'show'])->name('kategori.show');

// Product routes
Route::prefix('produk')->group(function () {
    // List all products with filters
    Route::get('/', [ProdukUserController::class, 'index'])->name('products.index');

    // Show a specific product
    Route::get('/{id}', [ProdukUserController::class, 'show'])->name('products.show');

    // List products by category
    Route::get('/category/{categoryId}', [ProdukUserController::class, 'byCategory'])->name('products.category');

    // List newest products
    Route::get('/newest', [ProdukUserController::class, 'newest'])->name('products.newest');

    // Filter products by price
    Route::get('/filter-by-price', [ProdukUserController::class, 'filterByPrice'])->name('products.filter.price');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
    Route::put('/cart/item/{itemId}', [CartController::class, 'updateItem']);
    Route::delete('/cart/item/{itemId}', [CartController::class, 'removeItem']);
    Route::delete('/cart/clear', [CartController::class, 'clearCart']);
    Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');
    Route::get('/cart/check/{productId}', [CartController::class, 'checkProduct']);
    Route::get('/cart/validate', [CartController::class, 'validateCart']);

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
    Route::post('/transaksi/{id}/upload-bukti', [TransaksiController::class, 'uploadBukti'])->name('transaksi.uploadBukti');
    Route::post('/transaksi/upload-batch', [TransaksiController::class, 'uploadBatch'])->name('transaksi.uploadBatch');

    Route::post('/checkout/complete', [TransaksiController::class, 'completeCheckout'])->name('checkout.complete');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Produk routes
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori_produk', KategoriAdminController::class);
    Route::resource('users', UserController::class);
    Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [AdminTransaksiController::class, 'show'])->name('transaksi.show');
    Route::put('/transaksi/{id}/status', [AdminTransaksiController::class, 'updateStatus'])->name('admin.transaksi.updateStatus');

    Route::patch('/transaksi/{id}/update-status', [AdminTransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');

    Route::get('/laporan', [AdminTransaksiController::class, 'laporan'])->name('laporan');
    Route::get('/export-pdf', [AdminTransaksiController::class, 'exportPdf'])->name('transaksi.exportPdf');

    Route::patch('/produk/{id}/ubah-stok', [ProdukController::class, 'ubahStok'])->name('produk.ubahStok');
});

// Search routes
Route::get('/search', [ProdukUserController::class, 'search'])->name('products.search');
Route::get('/quick-search', [ProdukUserController::class, 'quickSearch'])->name('products.quick-search');
