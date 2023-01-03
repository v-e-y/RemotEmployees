<?php

namespace App\Listeners;

use App\Models\Product;
use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use App\Events\CategoryUpdated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearProductsCache
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param  \App\Events\ProductCreated  $event
     * @return void
     */
    public function handle(ProductCreated|ProductDeleted $event)
    {
        Cache::forget(Product::class);

        if ($event->product->categories->count()) {
            foreach ($event->product->categories as $category) {
                Cache::forget(Category::class . '_' . $category->id . '_products');
            }
        }
    }
}
