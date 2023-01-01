<?php

declare(strict_types=1);

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AppController::class, 'index'])
    ->name('index');

require __DIR__ . '/product.php';
require __DIR__ . '/category.php';
