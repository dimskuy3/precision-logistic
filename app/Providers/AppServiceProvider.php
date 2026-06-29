<?php

namespace App\Providers;

use App\Models\PolData;
use App\Policies\PolDataPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::policy(PolData::class, PolDataPolicy::class);
        Paginator::useTailwind();
    }
}
