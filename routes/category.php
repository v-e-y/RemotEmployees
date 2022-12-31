<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;

Route::name('category.')->prefix('category')->group(function () {
    Route::get('/create', [CategoryController::class, 'create'])
        ->name('create');

    Route::post('/store', [CategoryController::class, 'store'])
        ->name('store');

    Route::get('/{category}/edit', [CategoryController::class, 'edit'])
        ->name('edit');

    Route::post('/{category}/update', [CategoryController::class, 'update'])
        ->name('update');

    Route::get('/{category}/destroy', [CategoryController::class, 'destroy'])
        ->name('destroy');
});