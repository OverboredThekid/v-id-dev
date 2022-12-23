<div>
    <body onload="printpart()">
        <div id="svg-card">
            <style class="table">
                @media print {
                    #svg-card {
                        display: block !important;
                    }

                }

                html,
                body {
                    margin: 0;
                    padding: 0;
                }

                @page {
                    size: auto;
                    /* auto is the initial value */
                    margin: 0;
                    /* this affects the margin in the printer settings */
                }
            </style>
            <svg id="Layer_2" class='' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 153.87 240.5">
                <defs>
                    <style>
                        .cls-1 {
                            font-size: 15px;
                        }

                        .cls-1,
                        .cls-2,
                        .cls-3 {
                            font-family: MyriadPro-Regular, 'Myriad Pro';
                        }

                        .cls-1,
                        .cls-2,
                        .cls-3,
                        .cls-4 {
                            fill: #231f20;
                        }

                        .cls-2 {
                            font-size: 20px;
                        }

                        .cls-5 {
                            fill: #333;
                        }

                        .cls-3 {
                            font-size: 17px;
                        }

                        .cls-6 {
                            letter-spacing: -.07em;
                        }

                        .cls-7 {
                            letter-spacing: -.03em;
                        }

                        .cls-8 {
                            letter-spacing: 0em;
                        }

                        .cls-9 {
                            fill: #ed1c24;
                            stroke: #ed1c24;
                            stroke-miterlimit: 10;
                            stroke-width: 2px;
                        }
                    </style>
                </defs>
                <g id="Back_ID">
                    <line id="Red_Dash_Linw" class="cls-9" x1="61.68" y1="188.25" x2="145.09" y2="187.45" /><text class="cls-3" transform="translate(60.24 230.96)">
                        <tspan x="0" y="0">EXP 12.2022</tspan>
                    </text><text class="cls-2" transform="translate(78.03 211.66)">
                        <tspan x="0" y="0">STAFF</tspan>
                    </text><text class="cls-1" transform="translate(55.22 150.66) scale(1.48 1)" lengthAdjust="spacing" textLength="65">


                        <tspan class="cls-8" x="0" y="0">{{$staff_first}}</tspan>

                        <tspan x="0" y="18">{{$staff_last}}</tspan>

                    </text>
                    <image style="overflow:visible;" width="377" height="379" id="WORKER-IMG" xlink:href="{{$staff_img}}" transform="matrix(0.2535 0 0 0.2535 56.6439 30.8369)"></image>

                    <rect id="Background_Color" class="cls-5" width="54.17" height="240.5" />
                    <image id="GAV_Small_Logo" width="681" height="228" transform="translate(2.61 190.46) rotate(-90) scale(.21)" xlink:href="{{ asset('assets/img/gav-small-white.png') }}" />
                </g>
            </svg>
            <svg id="Layer_2" class='' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 155.52 232.23">
                <defs>
                    <style>
                        .back-1 {
                            fill: #fff;
                            stroke: #fff;
                        }

                        .back-1,
                        .back-2 {
                            stroke-miterlimit: 10;
                            stroke-width: 2px;
                        }

                        .back-3 {
                            fill: #333;
                        }

                        .back-4 {
                            font-family: MyriadPro-Regular, 'Myriad Pro';
                            font-size: 17px;
                        }

                        .back-4,
                        .back-2 {
                            fill: #231f20;
                        }

                        .back-2 {
                            stroke: #ed1c24;
                        }
                    </style>
                </defs>
                <g id="Front_ID"><text class="back-4" transform="translate(27.7 227.98)">
                        <tspan x="0" y="0">888-812-2757</tspan>
                    </text>
                    <line id="Red_Deviding_Line" class="back-2" x1="36.06" y1="204.36" x2="119.46" y2="203.56" />
                    <rect id="Background_Color_333333_" class="back-3" width="155.52" height="114.26" />
                    <line id="White_Dash" class="back-1" x1="31.06" y1="108.64" x2="125" y2="108.64" />
                    <image id="GAV_Big_Logo" width="1340" height="538" transform="translate(3.71 30.74) scale(.11)" xlink:href="{{ asset('assets/img/gav-big-white.png') }}" />
                    {!! QrCode::size(95)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9') !!}
                </g>
            </svg>
        </div>
        <script>
            function printpart() {
                window.print();
                //setTimeout(window.close, 0);
            }
        </script>
        {{$staff}}
</div>