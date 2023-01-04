<head>
    <title>{{ config('app.name') }} ~ photo</title>
<!-- Include alpine.js -->
<script src="{{ asset('vendor/alpine.js') }}"></script>
<!-- Include cropper.js -->
<link rel="stylesheet" href="{{ asset('vendor/cropper.js/cropper.css') }}">
<script src="{{ asset('vendor/cropper.js/cropper.js') }}"></script> 
    @livewireStyles
</head>
<body>
    {{ $slot }}
</body>
<footer>
    @livewireScripts
</footer>