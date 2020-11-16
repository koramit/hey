<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Monitors</title>
</head>
<body>
    @if($services)
        @foreach(['valve', 'ad', 'scabbers', 'smuggle'] as $service)
        <h3>{{ $service }}</h3>
        <ul>
            <?php $last = collect($services[$service])->last(); ?>
            <li>
                <span style="color: {{ $last['status'] == 'ONLINE' ? 'green':'red'  }};">{{ $last['status'] }}</span>
                <span> @ {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $last['timestamp'])->diffForHumans(now()) }}</span>
            </li>
            @if($last['status'] == 'ONLINE')
            <?php
                $service = collect($services[$service]);
                $reversed = $service->reverse();
                $found = $reversed->search(function ($record) { return $record['status'] === 'OFFLINE'; });
                if ($found !== false) {
                    $lastKnownOffline = $reversed[$found];
                } else {
                    $lastKnownOffline = null;
                }
            ?>
            <li>
                LAST KNOWN OFFLINE @ 
                @if($lastKnownOffline['timestamp'])
                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lastKnownOffline['timestamp'])->diffForHumans(now()) }}
                @else
                NONE
                @endif
            </li>
            @else
            <?php
                $service = collect($services[$service]);
                $reversed = $service->reverse();
                $found = $reversed->search(function ($record) { return $record['status'] === 'ONLINE'; });
                if ($found !== false) {
                    $lastKnownOnline = $reversed[$found];
                } else {
                    $lastKnownOnline = null;
                }
            ?>
            <li>
                LAST KNOWN ONLINE @ 
                @if($lastKnownOnline['timestamp'])
                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lastKnownOnline['timestamp'])->diffForHumans(now()) }}
                @else
                NONE
                @endif
            </li>
            @endif
        </ul>
        @endforeach
    @endif
</body>
</html>
