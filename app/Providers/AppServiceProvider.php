<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        
        Schema::defaultStringLength(191);
        if (! Collection::hasMacro('paginate')) {
            Collection::macro(
                'paginate',
                function (int $perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage),
                        $this->count(),
                        $perPage,
                        $page,
                        $options
                    ))->withPath('');
                }
            );
        }

        View::share(
            'categories_menu', 
            CategoryRepository::getAllCategories()
        );
    }
}
