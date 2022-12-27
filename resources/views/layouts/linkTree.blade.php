<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

    <title>{{ config('app.name', 'Company Links') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.css" rel="stylesheet">
</head>
<body>
    {{ $slot }}
</body>
<footer>
    @livewireScripts
</footer>