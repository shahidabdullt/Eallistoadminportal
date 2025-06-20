<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Subscription;

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
        // Register the Cashier webhook controller
        // Cashier::ignoreMigrations(); // If you want to publish and customize the migrations

        // Configure currency and settings
        Cashier::useCustomerModel(User::class);
        Cashier::useSubscriptionModel(Subscription::class);

        Paginator::useBootstrapFive();
    }
}
