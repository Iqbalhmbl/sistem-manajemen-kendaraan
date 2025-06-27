<?php

namespace App\Providers;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Models\Role;
use Carbon\Laravel\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app()->bind(
            \Spatie\Permission\Models\Role::class,
            \App\Models\Role::class
        );
    }
}

