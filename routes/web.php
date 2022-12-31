<?php

declare(strict_types=1);

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AppController::class, 'index'])
    ->name('index');

require __DIR__ . '/product.php';
require __DIR__ . '/category.php';

Route::get('{category_name}/{product_id}', [CategoryController::class, 'showProducts'])
    ->name('categoryProducts');