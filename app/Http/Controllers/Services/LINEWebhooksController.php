<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LINEWebhooksController extends Controller
{
    /**
    * LINE request limit as of 2020-11-06
    * https://developers.line.biz/en/reference/messaging-api/#rate-limits
    * Other API endpoints 100,000 requests per minute 1,700 requests per second*
    */
    public function __invoke()
    {
        Log::error(['app' => 'LINE', 'payload' => Request::all()]);

        if (! Request::has('events')) { // this should never happend
            Log::error('LINE bad response');
            return abort(400);
        }

        foreach (Request::input('events') as $event) {
            if ($event['type'] == 'follow') {
                $this->follow($event);
            } elseif ($event['type'] == 'unfollow') {
                $this->unfollow($event);
            } elseif ($event['type'] == 'message') {
                //
            } elseif ($event['type'] == 'unsend') {
                //
            } else {
                // unhandle type
            }
        }
    }

    protected function follow($event)
    {
        // get profile
        $response = Http::withToken(config('services.line_bot.token'))
                        ->get('https://api.line.me/v2/bot/profile/' . $event['source']['userId']);
        // if ($response->ok()) {
        Log::error($response->body());
        // }

        $profile = $response->json();

        // reply
        $response = Http::withToken(config('services.line_bot.token'))
                        ->post('https://api.line.me/v2/bot/message/reply', [
                            'replyToken' => $event['replyToken'],
                            'messages' => [
                                ['type' => 'text', 'text' => "สวัสดี {$profile['displayName']} 😃\nขอบคุณที่เป็นเพื่อนกับ Wordplease 🐻\n\nโปรดลงทะเบียนโดยการพิมพ์ verification code ส่งมาที่นี่เลย\n\n✌️"],
                                // ['type' => 'text', 'text' => 'เชิญลงทะเบียนก่อนเลย']
                            ]
                        ]);


        // save or update profile
    }

    protected function unfollow($event)
    {
        Log::error($event['source']['userId'] . ' unfollow');
    }
}
