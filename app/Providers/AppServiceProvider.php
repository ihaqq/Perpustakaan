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
        // Force HTTPS for ngrok to avoid mixed-content error
        if (config('app.env') !== 'local' || request()->server('HTTP_X_FORWARDED_PROTO') == 'https') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
