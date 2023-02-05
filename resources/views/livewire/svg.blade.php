<div>

    <body onload="printpart()">
        <div id="svg-card">
            <style class="table">
                @media print {
                    
                }
                @media print {
                    #svg-card {
                        display: block !important;
                    }
                    
                    

                }

                html,
                body {
                    margin: 0;
                    padding: 0;
                    font-size: 12px;
                    min-font-size: 10px;
                    max-font-size: 14px;
                }
                .cls-1 {
            font-size: 12px;
            min-font-size: 10px;
            max-font-size: 14px;
        }
                @page {
                    size: auto;
                    /* auto is the initial value */
                    margin: 0;
                    /* this affects the margin in the printer settings */
                }
            </style>
            <div id="svg_front">
            {!! $svg_front !!}
            </div>
            <div id="svg_back">
            {!! $svg_back !!}
            </div>
        </div>
        <script>
            function printpart() {
                window.print();
                setTimeout(window.close, 0);
            }
        </script>
</div>