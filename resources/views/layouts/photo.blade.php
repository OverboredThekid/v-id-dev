<head>
    <title>{{ config('app.name') }} ~ photo</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
</head>
<body>
    {{ $slot }}
</body>
<footer>
    @livewireScripts
</footer>