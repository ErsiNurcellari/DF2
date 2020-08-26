<?php

namespace App\Providers;

use App\Listeners\InstallationCompletedListener;
use App\Listeners\User\EmailVerificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use RachidLaasri\LaravelInstaller\Events\LaravelInstallerFinished;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            EmailVerificationListener::class,
        ],
        LaravelInstallerFinished::class => [
            InstallationCompletedListener::class
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            'SocialiteProviders\\Envato\\EnvatoExtendSocialite@handle',
        ],
    ];


    protected $subscribe = [

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
