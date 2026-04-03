<?php

namespace App\Providers;

use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Route;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AppServiceProvider_copy extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
{ if (app()->environment('local')) 
{ URL::forceScheme('https'); } }
    // public function register(){
    // $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    // }
}
