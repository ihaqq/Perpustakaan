<?php

namespace App\Providers;

use App\Repositories\BookRepository;
use App\Repositories\GenreRepository;
use App\RepositoriesInterface\BookRepositoryInterface;
use App\RepositoriesInterface\GenreRepositoryInterface;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Binding seharusnya di sini
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(GenreRepositoryInterface::class, GenreRepository::class);
    }

    public function boot(): void
    {
        // if (app()->environment('local')) 
        // { URL::forceScheme('https'); } 
    }
}
