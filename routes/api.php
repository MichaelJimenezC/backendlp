<?php
// routes/api.php
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CorsMiddleware;

// Aplicar CORS middleware a todas las rutas del grupo
Route::middleware([CorsMiddleware::class])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/products', [ProductController::class, 'store']);
});
