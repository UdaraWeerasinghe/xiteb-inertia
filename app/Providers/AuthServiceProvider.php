<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('USER ADD', function () { return $this->checkPermission('USER ADD');});
        Gate::define('USER VIEW', function () { return $this->checkPermission('USER VIEW');});

        Gate::define('PRODUCT VIEW', function () { return $this->checkPermission('PRODUCT VIEW');});
        Gate::define('PRODUCT ADD', function () { return $this->checkPermission('PRODUCT ADD');});

        Gate::define('PRESCRIPTION ADD', function () { return $this->checkPermission('PRESCRIPTION ADD');});
        Gate::define('PRESCRIPTION VIEW', function () { return $this->checkPermission('PRESCRIPTION VIEW');});
        Gate::define('PRESCRIPTION VIEW DETAILS', function () { return $this->checkPermission('PRESCRIPTION VIEW DETAILS');});
        
        Gate::define('QUETATION ADD', function () { return $this->checkPermission('QUETATION ADD');});
        Gate::define('QUETATION ACCEPT', function () { return $this->checkPermission('QUETATION ACCEPT');});
        Gate::define('QUETATION REJECT', function () { return $this->checkPermission('QUETATION REJECT');});
        Gate::define('QUETATION SEND', function () { return $this->checkPermission('QUETATION SEND');});
        Gate::define('QUETATION VIEW', function () { return $this->checkPermission('QUETATION VIEW');});

    }

    function checkPermission($can){  
        
        $authUserType = auth()->user()->type;
        $authUserId = auth()->user()->id;

            $usePermissions = [
                [
                    'type' => 1,
                    'name' => 'pharmacy',
                    'cans' => [ 
                        ['name' => 'USER ADD'],
                        [ 'name' => 'USER VIEW'],
                        [ 'name' => 'PRODUCT VIEW'],
                        [ 'name' => 'PRODUCT ADD'],
                        [ 'name' => 'PRESCRIPTION VIEW'],
                        [ 'name' => 'PRESCRIPTION VIEW DETAILS'],
                       
                        [ 'name' => 'QUETATION SEND'],
                        [ 'name' => 'QUETATION VIEW'],

                    ]
                ],
                [
                    'type' => 2,
                    'name' => 'user',
                    'cans' => [
                        [ 'name' => 'PRESCRIPTION ADD'],
                        [ 'name' => 'PRESCRIPTION VIEW'],
                        [ 'name' => 'QUETATION ACCEPT'],
                        [ 'name' => 'QUETATION REJECT'],
                        [ 'name' => 'PRESCRIPTION VIEW DETAILS'],
                        [ 'name' => 'QUETATION VIEW'],
                    ],
                ]
            ];

            $permissions = collect($usePermissions)->where('type',$authUserType)->first()['cans'];

            $isAvailable = collect($permissions)->where('name',$can)->first();

            return !empty($isAvailable);

    }

}
