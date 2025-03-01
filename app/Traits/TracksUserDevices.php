<?php

namespace App\Traits;

use Jenssegers\Agent\Agent;

trait TracksUserDevices
{
    /**
     * Get user device information from request
     */
    public function getDeviceInfo(): array
    {
        $agent = new Agent();

        return [
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'device' => $this->getDeviceType($agent),
            'registration_ip' => request()->ip(),
        ];
    }

    /**
     * Get device type (Desktop, Phone, Tablet)
     */
    protected function getDeviceType(Agent $agent): string
    {
        if ($agent->isTablet()) {
            return 'Tablet';
        }

        if ($agent->isMobile()) {
            return 'Phone';
        }

        return 'Desktop';
    }
}
