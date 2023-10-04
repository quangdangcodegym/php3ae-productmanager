<?php

namespace App\Providers;

use App\Repositories\Impl\ProductRepository;
use App\Repositories\IProductRepository;
use App\Services\Impl\ProductService;
use App\Services\IProductService;

use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(IProductRepository::class, ProductRepository::class);
        $this->app->singleton(IProductService::class, ProductService::class);
    }
}
