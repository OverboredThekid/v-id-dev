<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

    <title>{{ config('app.name', 'Company Links') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.css" rel="stylesheet">
</head>
<style>
    body {
        width: 100wh;
        height: 90vh;
        color: #fff;
        background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
        background-size: 400% 400%;
        -webkit-animation: Gradient 15s ease infinite;
        -moz-animation: Gradient 15s ease infinite;
        animation: Gradient 15s ease infinite;
    }

    h1,
    h6 {
        font-family: 'Open Sans';
        font-weight: 300;
        text-align: center;
        position: absolute;
        top: 45%;
        right: 0;
        left: 0;
    }

    .element {
        margin: 0 auto;
        width: 150px;
        height: 150px;
        background: red;
    }
</style>

<body>
    <div class="container mx-auto">
        <div class="col-xs-12">
            <div class="text-center py-10">
                <img class="backdrop linktree">
                <h2 class="text-white py-5">{{ config('app.name', 'Company Links') }}</h2>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="col-xs-12">
            <div class="text-center">
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" class="text-white-500 border border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase w-1/2 px-8 py-3 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Staff Links</button>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
</body>
<footer>
    @livewireScripts
</footer>