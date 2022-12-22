<head>
    <title>{{ config('app.name') }} ~ SVG</title>
    @livewireStyles
</head>
<body>
    {{ $slot }}
</body>
<footer>
    @livewireScripts
</footer>