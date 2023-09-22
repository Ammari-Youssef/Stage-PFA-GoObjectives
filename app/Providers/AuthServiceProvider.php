<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Objective;
use App\Models\Result;
use App\Models\User;
use App\Policies\ObjectivePolicy;
use App\Policies\ProgressPolicy;
use App\Policies\ResultPolicy;
use App\Policies\TaskPolicy;
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
        //
        Objective::class => ObjectivePolicy::class,
        Task::class => TaskPolicy::class,
        Progress::class => ProgressPolicy::class,
        Result::class =>ResultPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
   
    }
}
