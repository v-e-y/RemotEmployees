<?php

namespace App\Listeners;

use App\Events\CategoryUpdated;
use App\Events\ProductUpdated;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearProductCache
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
     * @param  \App\Events\ProductUpdated  $event
     * @return void
     */
    public function handle(ProductUpdated $event)
    {
        Cache::forget(Product::class);
        Cache::forget(Product::class . '_id_' . $event->product->id);

        if ($event->product->categories->count()) {
            foreach ($event->product->categories as $category) {
                CategoryUpdated::dispatch($category);
            }
        }
    }
}
