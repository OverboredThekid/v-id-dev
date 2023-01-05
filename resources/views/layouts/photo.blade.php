<head>
    <title>{{ config('app.name') }} ~ photo</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.9/dist/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.x.x/webcam.min.js"></script>
    @livewireStyles
</head>
<body>
    {{ $slot }}
</body>
<footer>
    @livewireScripts
</footer>