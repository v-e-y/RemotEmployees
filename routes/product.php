<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

Route::name('product.')->prefix('products')->group(function () {
    Route::get('/create', [ProductController::class, 'create'])
        ->name('create');

    Route::post('/store', [ProductController::class, 'store'])
        ->name('store');

    Route::get('/{product_id}', [ProductController::class, 'show'])
        ->name('show');

    Route::get('/{product}/edit', [ProductController::class, 'edit'])
        ->name('edit');

    Route::post('/{product}/update', [ProductController::class, 'update'])
        ->name('update');

    Route::get('/{product}/destroy', [ProductController::class, 'destroy'])
        ->name('destroy');
});