<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
   Gate::define('user-delete', function($user){
    return $user->hasPermissionTo('user-delete');
    // return $user->hasRole('admin')||$usser->can('delete');
    // return $user->Role('admin')==='admin';
   });
   
   Gate::define('user-edit', function($user){
    return $user->hasPermissionTo('user-edit');
   });
   
    Gate::define('user-create', function($user){
    return $user->hasPermissionTo('user-create');
   });
    }
}
  