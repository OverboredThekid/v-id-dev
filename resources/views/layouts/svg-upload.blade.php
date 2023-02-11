<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} ~ SVG</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    {{ $slot }}
</body>