<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class TelegramWebhooksController extends Controller
{
    public function __invoke()
    {
        Log::error(['app' => 'Telegram', 'payload' => Request::all()]);   
    }
}
