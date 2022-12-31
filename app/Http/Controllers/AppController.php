<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

final class AppController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'products' => Product::all()
        ]);
    }
}