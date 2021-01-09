<?php

namespace App\Managers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WordpleaseMonitorManager extends MonitorManager
{
    public function handleDowntime()
    {
        $boot = Http::withOptions(['verify' => false])->get(env('WORDPLEASE_BOOT_URL'));
        Log::info($boot->body());
        if (! $boot->ok()) {
            Log::error('WORDPLEASE BOOT URL IS DOWN');
        } else {
            Log::error('WORDPLEASE BOOT URL IS UP');
        }
        parent::handleDowntime();
    }
}
