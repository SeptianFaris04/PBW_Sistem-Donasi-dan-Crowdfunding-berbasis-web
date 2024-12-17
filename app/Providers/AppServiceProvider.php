<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Donasi;
use App\Models\Category;
use App\Models\UrunDana;
use App\Observers\DonasiObserver;
use App\Observers\CategoryObserver;
use App\Observers\UrunDanaObserver;
use Illuminate\Support\Facades\Gate;
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
        Category::observe(CategoryObserver::class);
        Donasi::observe(DonasiObserver::class);
        UrunDana::observe(UrunDanaObserver::class);
        
        Gate::define('edit-donasi', function (User $user, Donasi $donasi) {
            return $user->id === $donasi->user_id;
        });

        Gate::define('hapus-donasi', function (User $user, Donasi $donasi){
            return $user->id === $donasi->user_id;
        });
    }
}
