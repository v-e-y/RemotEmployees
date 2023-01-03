<?php

namespace App\Listeners;

use App\Events\CategoryDeleted;
use App\Events\CategoryUpdated;
use App\Events\ProductUpdated;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearCategoryCache
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
     * @param  \App\Events\CategoryUpdated  $event
     * @return void
     */
    public function handle(CategoryUpdated|CategoryDeleted $event)
    {
        Cache::forget(Category::class);
        Cache::forget(Category::class . '_id_' . $event->category->id);
        Cache::forget(Category::class . '_' . $event->category->id . '_products');

        if ($event->category->products->count()) {
            foreach ($event->category->products as $product) {
                ProductUpdated::dispatch($product);
            }
        }
    }
}
