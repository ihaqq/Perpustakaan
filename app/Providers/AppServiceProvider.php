<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Binding seharusnya di sini
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    }

    public function boot(): void
    {
        // Tidak perlu mendefinisikan route di Laravel 11
    }
}
