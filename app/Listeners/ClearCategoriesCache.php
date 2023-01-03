<?php

namespace App\Listeners;

use App\Models\Category;
use App\Events\CategoryCreated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearCategoriesCache
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
     * @param  \App\Events\CategoryCreated  $event
     * @return void
     */
    public function handle(CategoryCreated $event)
    {
        Cache::forget(Category::class);
    }
}
