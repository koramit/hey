<?php

use App\Http\Controllers\Services\LINEWebhooksController;
use App\Http\Controllers\Services\TelegramWebhooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Hey ! v0.1';
});


// WEBKOOKS
Route::post('/webhooks/line', LINEWebhooksController::class);
Route::post('/webhooks/telegram/{token}', TelegramWebhooksController::class);

// MONITOR
Route::post('/monitor', function () {
    $request = \Request::all();
    if (($request['token'] ?? null) !== env('MONITOR_TOKEN')) {
        \Log::info('abort');
        abort(401);
    }

    \Log::info(json_encode($request['data']));

    $services = \Cache::get('services', ['valve' => [], 'ad' => [], 'scabbers' => []]);

    foreach (['valve', 'ad', 'scabbers'] as $service) {
        $services[$service][] = [
            'timestamp' => $request['data']['timestamp'],
            'status' => $request['data'][$service]['status'],
            'error' => $request['data'][$service]['error'] ?? null,
        ];
    }
    \Cache::put('services', $services);
});

Route::get('/monitor', function () {
    return view('monitor', ['services' => \Cache::get('services', [])]) ;
});
