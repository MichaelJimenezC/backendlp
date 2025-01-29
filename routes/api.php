<?php
// routes/api.php
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);   // Obtener todos los productos
Route::get('/products/{id}', [ProductController::class, 'show']); // Obtener un solo producto
Route::post('/products', [ProductController::class, 'store']);   // Crear un producto
