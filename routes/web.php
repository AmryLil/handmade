<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriAdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukUserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/produk', function () {
//     return view('pages/users/toko');
// });
Route::get('/produk/1', function () {
    return view('pages/users/produk');
});
Route::get('/login', function () {
    return view('pages/auth/login');
});
Route::get('/signup', function () {
    return view('pages/auth/signup');
});

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

Route::prefix('admin')->name('admin.')->group(function () {
    // Produk routes
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori_produk', KategoriAdminController::class);
});

// Search routes
Route::get('/search', [ProdukUserController::class, 'search'])->name('products.search');
Route::get('/quick-search', [ProdukUserController::class, 'quickSearch'])->name('products.quick-search');
