<?php

namespace App\Providers;

use App\Events\CategoryCreated;
use App\Events\CategoryDeleted;
use App\Events\CategoryUpdated;
use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use App\Events\ProductUpdated;
use App\Listeners\ClearCategoriesCache;
use App\Listeners\ClearCategoryCache;
use App\Listeners\ClearProductCache;
use App\Listeners\ClearProductsCache;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     * @var array<class-string,array<int,class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProductCreated::class => [
            ClearProductsCache::class
        ],
        ProductUpdated::class => [
            ClearProductCache::class
        ],
        ProductDeleted::class => [
            ClearProductsCache::class
        ],
        CategoryCreated::class => [
            ClearCategoriesCache::class
        ],
        CategoryUpdated::class => [
            ClearCategoryCache::class
        ],
        CategoryDeleted::class => [
            ClearCategoryCache::class
        ],
    ];

    /**
     * Register any events for your application.
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
