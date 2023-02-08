<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} ~ SVG</title>
    @livewireStyles
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    {{ $slot }}
</body>
