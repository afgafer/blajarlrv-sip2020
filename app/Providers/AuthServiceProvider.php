<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',  //gate
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-create', function ($user,$admin) {
            return $admin->id == 1;
        });
        Gate::define('admin-edit', function ($user,$admin) {
            //dd($admin->user_id);
            //dd($user->id);
            if($user->id==$admin->user_id){
                $result=true;
            }else{
                $result=false;
            }
            return $result;
        });
    }
}
