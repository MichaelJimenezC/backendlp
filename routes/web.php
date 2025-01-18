<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/categories', [CategoryController::class, 'index']); // Mostrar todas las categorías
Route::post('/categories', [CategoryController::class, 'store']); // Crear categoría
Route::get('/categories/{id}', [CategoryController::class, 'show']); // Ver una categoría
Route::put('/categories/{id}', [CategoryController::class, 'update']); // Actualizar categoría
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']); // Eliminar categoría

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::middleware('auth')->post('/products', [ProductController::class, 'store']);
Route::get('/create-product', [ProductController::class, 'create'])->name('create-product')->middleware('auth');

Route::get('/cart', [CartItemController::class, 'index']);
Route::post('/cart', [CartItemController::class, 'store']);
Route::delete('/cart/{id}', [CartItemController::class, 'destroy']);

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'index']);

Route::get('/reviews/{productId}', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);

// Ruta para mostrar el formulario de creación de categorías
Route::get('/create-category', function () {
    return view('create_category');
})->name('create-category');
// Ruta para el formulario de subir producto

require __DIR__.'/auth.php';
