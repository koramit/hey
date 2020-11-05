<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LINEWebhooksController extends Controller
{
    public function __invoke()
    {
        Log::error(['app' => 'LINE', 'payload' => Request::all()]);
    }
}
