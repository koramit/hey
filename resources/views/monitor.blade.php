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
            <li style="color: {{ $last['status'] == 'ONLINE' ? 'green':'red'  }};">{{ $last['status'] }}</li>
            <li>{{ $last['timestamp'] }}</li>
        </ul>
        @endforeach
    @endif
</body>
</html>
