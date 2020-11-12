<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Monitors</title>
</head>
<body>
    @if($services)
        @foreach(['valve', 'ad', 'scabbers'] as $service)
        <h3>{{ $service }}</h3>
        <ul>
            <?php $last = collect($services[$service])->last(); ?>
            <li>
                <span style="color: {{ $last['status'] == 'ONLINE' ? 'green':'red'  }};">{{ $last['status'] }}</span>
                <span> @ {{ $last['timestamp'] }}</span>
            </li>
            @if($last['status'] == 'ONLINE')
            <?php
                $service = collect($services[$service]);
                $reversed = $service->reverse();
                $lastKnownOffline = $reversed->search(function ($record) { return $record['status'] === 'OFFLINE'; });
            ?>
            <li>
                LAST KNOWN OFFLINE @ {{ $lastKnownOffline['timestamp'] }}
            </li>
            @endif
        </ul>
        @endforeach
    @endif
</body>
</html>
