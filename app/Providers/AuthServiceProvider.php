<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Registrar las Gates definidas
        //$this->registerGates();

        // ejemplo de Gate.
        /*    
        Gate::define('view_product', function (User $user) {
            if($user->role->hasPermission('view_product')){
                return true;
            }
            return false;
        });
        Gate::define('create_product', function (User $user) {
            if($user->role->hasPermission('create_product')){
                return true;
            }
            return false;
        }); */
    }
}
