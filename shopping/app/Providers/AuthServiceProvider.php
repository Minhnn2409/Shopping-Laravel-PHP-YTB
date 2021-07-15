<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\PermissionAccess;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissionAccess = new PermissionAccess();
        $permissionAccess->setGateAndPolicyAccess();

        $this->productPermission();
    }


    public function productPermission()
    {
        Gate::define('product-list', 'App\Policies\ProductPolicy@view');
        Gate::define('product-edit', function ($user, $id) {
            $product = Product::find($id);
            if ($user->checkPermissionAccess(config('permissions.access.product_edit')) && $user->id == $product->user_id) {
                return true;
            }
        });
    }
}
