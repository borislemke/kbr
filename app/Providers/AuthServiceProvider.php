<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // role: super admin, manager, super agent, agent
        // page: dashboard, properties(villa, villa rental, land), enquiry, customer, blog, page, setting

        $gate->define('property-edit', function ($user, $property_id) {

            $user = $user->get();

            $property = \App\Property::find($property_id);

            if ($user->role_id == 3 OR $user->role_id == 4) return $property->user_id == $user->id;

            if ($user->role_id == 2) return $property->user->branch_id == $user->branch_id;

            if ($user->role_id == 1) return true;

        });

        $gate->define('enquiry-edit', function ($user, $enquiry_id) {

            $user = $user->get();

            $enquiry = \App\Enquiry::find($enquiry_id);

            if ($user->role_id == 3 OR $user->role_id == 4) return $enquiry->property->user_id == $user->id;

            if ($user->role_id == 2) return $enquiry->property->user->branch_id == $user->branch_id;

            if ($user->role_id == 1) return true;

        });        

        $gate->define('customer-edit', function ($user, $customer_id) {

            $user = $user->get();

            $customer = \App\Customer::find($customer_id);

            // if ($user->role_id == 3 OR $user->role_id == 4) return $customer->user_id == $user->id;

            // if ($user->role_id == 2) return $customer->user->branch_id == $user->branch_id;

            if ($user->role_id == 1) return true;

        });

        $gate->define('user-edit', function ($user, $user_id) {

            $user = $user->get();

            $account = \App\User::find($user_id);

            if ($user->role_id == 2) return $account->branch_id == $user->branch_id;

            if ($user->role_id == 1) return true;

        });  

    }
}
