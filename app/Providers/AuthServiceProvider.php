<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Policies\ProductPolicy;
use App\Models\Category;
use App\Policies\CategoryPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Policy mappings
     */
    protected $policies = [
        Product::class  => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // optional fallback gates (you can remove later)
        Gate::define('admin-only', function ($user) {
            return $user->hasRole('admin');
        });
    }
}