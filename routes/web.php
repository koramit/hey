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
