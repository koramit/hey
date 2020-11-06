<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class TestPortal
{
    public static function run($time = 1000)
    {
        for ($count = 1;  $count <= $time; $count++) {
            $appName = 'super_valentine#' . $count;
            $appToken = Str::random(64);
            $response = Http::withOptions(['verify' => false])->asForm()->post('https://www.si.mahidol.ac.th/department/Medicine/home/api/portal/regis_app.asp', [
                            'token' => 'FfXKbWqWZeNiBcuS6xWt2B4Z6NtQZMQi',
                            'app_name' => $appName,
                            'app_token' => $appToken
                        ]);

            if (! $response->ok()) {
                Log::info(now()->format('Y-m-d H:m:s.u') . ' create failed');
                continue;
            }

            if ($count % 2 == 0) {
                $appToken = 'imnongka';
            }
            
            $response = Http::withOptions(['verify' => false])->asForm()->post('https://www.si.mahidol.ac.th/department/Medicine/home/api/portal/auth_app.asp', [
                            'app_name' => $appName,
                            'app_token' => $appToken
                        ]);

            if (! $response->ok()) {
                Log::info(now()->format('Y-m-d H:m:s.u') . ' auth failed');
                continue;
            }

            Log::info(now()->format('Y-m-d H:m:s.u') . ' ok');
        }
    }
}
