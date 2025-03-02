<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $deviceInfo = $user->getDeviceInfo();

        // Update last login info
        $user->update([
            'last_login' => now(),
            'last_ip' => request()->ip(),
            'login_count' => ($user->login_count ?? 0) + 1,
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],
            'device' => $deviceInfo['device'],
        ]);

        // Update location data
        $user->updateLocationData();
    }
}
