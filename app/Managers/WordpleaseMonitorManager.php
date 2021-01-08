<?php

namespace App\Managers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WordpleaseMonitorManager extends MonitorManager
{
    public function handleDowntime()
    {
        if (! Http::withOptions(['verify' => false])->get(env('WORDPLEASE_BOOT_URL'))->ok()) {
            Log::error('WORDPLEASE BOOT URL DOWN');
        }
        parent::handleDowntime();
    }
}
