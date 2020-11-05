<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class TelegramWebhooksController extends Controller
{
    public function __invoke($token)
    {
        if ($token !== config('services.telegram_bot.token')) {
            abort(403);
        }
        Log::error(['app' => 'Telegram', 'payload' => Request::all()]);   
    }
}
