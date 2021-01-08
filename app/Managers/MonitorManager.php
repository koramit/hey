<?php

namespace App\Managers;

use App\Models\Uptime;
use Illuminate\Support\Facades\Log;

class MonitorManager
{
    protected $uptime;
    protected $minutesMarkAsDown = 3;

    public function __construct(Uptime $uptime)
    {
        $this->uptime = $uptime;
    }

    public function handleDowntime()
    {
        if ($this->isDown()) {
            Log::error($this->uptime->monitorService->name);
        }
    }

    protected function isDown()
    {
        $durationInMinutes = Uptime::whereMonitorServiceId($this->uptime->monitor_service_id)
                                    ->where('timestamp', '<=', $this->uptime->timestamp)
                                    ->orderBy('timestamp', 'desc')
                                    ->limit($this->minutesMarkAsDown)
                                    ->get()
                                    ->filter(function ($d) {
                                        return ! $d->online;
                                    })->count();

        return $this->minutesMarkAsDown <= $durationInMinutes;
    }
}
