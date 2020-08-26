<?php

namespace App\Listeners;

use App\Models\Seeder;
use Illuminate\Support\Facades\File;
use Laracasts\Flash\Flash;
use RachidLaasri\LaravelInstaller\Events\LaravelInstallerFinished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;


class InstallationCompletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LaravelInstallerFinished  $event
     * @return void
     */
    public function handle(LaravelInstallerFinished $event)
    {
        try {
            Artisan::call('storage:link');
            Artisan::call('optimize:clear');
        } catch (\Exception $e) {}

        if (request()->segment(1) == 'update') {
            request()->session()->forget('update_status');
            request()->session()->forget('isUpToDate');

            Flash::success('ChargePanda has been successfully updated.');
            return redirect()->route('ch-admin.ch_admin_dashboard', ['update_check' => true]);
        }
    }
}
