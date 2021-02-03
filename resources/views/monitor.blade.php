<!DOCTYPE html>
<html lang="th-TH">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monitors</title>
</head>

<body>
    <h1>Lastest Check-in </h1>
    <small>(please refresh)</small>
    <h2>wordplease ::
        {{ \App\Models\Uptime::whereMonitorServiceId(1)->orderBy('timestamp', 'desc')->first()->online ? 'ONLINE' : 'OFFLINE' }}
        ::
        {{ \App\Models\Uptime::whereMonitorServiceId(1)->orderBy('timestamp', 'desc')->first()->timestamp }}
    </h2>
    <h2>smuggle ::
        {{ \App\Models\Uptime::whereMonitorServiceId(2)->orderBy('timestamp', 'desc')->first()->online ? 'ONLINE' : 'OFFLINE' }}
        ::
        {{ \App\Models\Uptime::whereMonitorServiceId(2)->orderBy('timestamp', 'desc')->first()->timestamp }}
    </h2>
    <h2>lovesick ::
        {{ \App\Models\Uptime::whereMonitorServiceId(6)->orderBy('timestamp', 'desc')->first()->online ? 'ONLINE' : 'OFFLINE' }}
        ::
        {{ \App\Models\Uptime::whereMonitorServiceId(6)->orderBy('timestamp', 'desc')->first()->timestamp }}
    </h2>
</body>

</html>
