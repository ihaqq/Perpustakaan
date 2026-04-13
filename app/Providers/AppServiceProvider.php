<?php

namespace App\Providers;

use App\Repositories\AnggotaRepository;
use App\Repositories\BookRepository;
use App\Repositories\GenreRepository;
use App\Repositories\KelasRepository;
use App\Repositories\PeminjamanRepository;
use App\RepositoriesInterface\AnggotaRepositoryInterface;
use App\RepositoriesInterface\BookRepositoryInterface;
use App\RepositoriesInterface\GenreRepositoryInterface;
use App\RepositoriesInterface\KelasRepositoryInterface;
use App\RepositoriesInterface\PeminjamanRepositoryInterface;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Binding seharusnya di sini
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(GenreRepositoryInterface::class, GenreRepository::class);
        $this->app->bind(AnggotaRepositoryInterface::class, AnggotaRepository::class);
        $this->app->bind(KelasRepositoryInterface::class, KelasRepository::class);
        $this->app->bind(PeminjamanRepositoryInterface::class, PeminjamanRepository::class);
    }

    public function boot(): void
    {
        // if (app()->environment('local')) 
        // {
        //     URL::forceScheme('https');
        // }
    }
}
