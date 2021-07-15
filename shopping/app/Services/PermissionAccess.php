<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionAccess
{
    public function setGateAndPolicyAccess()
    {
        $this->categoryPermission();
    }

    public function categoryPermission()
    {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }

}
