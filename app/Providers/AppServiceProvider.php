<?php

namespace App\Providers;

use App\Models\Equipments;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
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
        $db = database_path('database.sqlite');

        if (!file_exists($db)) {
            if (!mkdir($concurrentDirectory = dirname($db), 0777, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }

            touch($db);

            try {
                Artisan::call('migrate:fresh', ['--force' => true]);
                Artisan::call('db:seed', ['--force' => true]);
            } catch (\Throwable $e) {
                \Log::error('Migrate failed: ' . $e->getMessage());
            }
        }
    }
}
