<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

    <title>{{ config('app.name', 'Company Links') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
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

    @-webkit-keyframes Gradient {
        0% {
            background-position: 0% 50%
        }

        50% {
            background-position: 100% 50%
        }

        100% {
            background-position: 0% 50%
        }
    }

    @-moz-keyframes Gradient {
        0% {
            background-position: 0% 50%
        }

        50% {
            background-position: 100% 50%
        }

        100% {
            background-position: 0% 50%
        }
    }

    @keyframes Gradient {
        0% {
            background-position: 0% 50%
        }

        50% {
            background-position: 100% 50%
        }

        100% {
            background-position: 0% 50%
        }
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

    .shake {
        animation: shake-animation 4.72s ease infinite;
        transform-origin: 50% 50%;
    }

    .element {
        margin: 0 auto;
        width: 150px;
        height: 150px;
        background: red;
    }

    @keyframes shake-animation {
        0% {
            transform: translate(0, 0)
        }

        1.78571% {
            transform: translate(5px, 0)
        }

        3.57143% {
            transform: translate(0, 0)
        }

        5.35714% {
            transform: translate(5px, 0)
        }

        7.14286% {
            transform: translate(0, 0)
        }

        8.92857% {
            transform: translate(5px, 0)
        }

        10.71429% {
            transform: translate(0, 0)
        }

        100% {
            transform: translate(0, 0)
        }
    }

    .backdrop {
        -moz-box-shadow: 0px 6px 5px #111;
        -webkit-box-shadow: 0px 6px 5px #111;
        box-shadow: 0px 2px 10px #111;
        -moz-border-radius: 190px;
        -webkit-border-radius: 190px;
        border-radius: 190px;
    }

    .linktree {
        width: 120px;
        height: 120px;
        background-image: url("https://i.imgur.com/oggcsIH.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 50%;
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
                    <button onclick="location.href='#'" type="button" class="bg-gray-300 w-1/2 py-3 font-semibold">15% OFF Instagram Growth</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" type="button" class="bg-gray-300 w-1/2 py-3 font-semibold">Guide: Increasing Your Engagement</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" type="button" class="bg-gray-300 w-1/2 py-3 font-semibold">View My YouTube Channel</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" type="button" class="bg-gray-300 w-1/2 py-3 font-semibold">Connect On LinkedIn</button>
                </div>
                <div class="py-5">
                    <button onclick="location.href='#'" type="button" class="bg-gray-300 w-1/2 py-3 font-semibold">My Personal Website</button>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center py-5">
        <a href="https://www.Back-lit.co/" class="text-gray-700" target="_blank">Powered by Back-Lit</a>
    </div>
    @yield('content')
</body>
<footer>
    @livewireScripts
</footer>