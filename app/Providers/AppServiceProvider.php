<?php

namespace App\Providers;

use Doctrine\DBAL\Types\Type;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

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
        JsonResource::withoutWrapping();
        Type::addType('timestamp', TimestampType::class);
    }
}
