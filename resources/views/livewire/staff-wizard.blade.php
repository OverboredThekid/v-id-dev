<div>
    <div id='wizard' class='wizard-body'>

        @if(!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
        @endif

        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'not-active' : 'active' }}">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'not-active' : 'active' }}">2</a>
                    <p>Step 2</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'not-active' : 'active' }}">3</a>
                    <p>Step 3</p>
                </div>
            </div>
        </div>

        <div class="row setup-content  {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3> Step 1</h3>

                    <div class="form-group">
                        <label for="title">First and Last Name:</label>
                        <input type="text" wire:model="name" class="form-control" id="taskTitle">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Email:</label>
                        <input type="text" wire:model="email" class="form-control" id="email" />
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Phone Number:</label>
                        <input type="text" wire:model="phone" class="form-control" id="phone" />
                        @error('phone') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">Next</button>
                </div>
            </div>
        </div>
        <div class="row setup-content  {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3> Step 2</h3>

                    <div class="form-group img-upload">
                        <label for="description">Image Upload</label>
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <input type="file" wire:model="file" :wire:key='file' class="form-control" id="file" x-show="!isUploading" />
                            <input type="hidden" wire:model="is_active" value="1">
                            <div class="mt-2" x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                            @isset($file)
                            <strong><img src="{{$file->temporaryUrl()}}" wire:ignore class='file-url' alt="Image of worker"></strong>
                            @endif
                            @error('file') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
                </div>
            </div>
        </div>
        <div class="row setup-content  {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3> Step 3</h3>
                    <table class="table ">
                        <tr>
                            <td>Full Name:</td>
                            <td><strong>{{$name}}</strong></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><strong>{{$email}}</strong></td>
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td><strong>{{$phone}}</strong></td>
                        </tr>
                    </table>
                    <?php
                    $name_split = explode(" ", $name);
                    $first_name = $name_split[0];
                    $last_name = !empty($name_split[1]) ? $name_split[1] : '';
                    ?>


                    <div id="svg-card">
                        <style class="table">
                            @media print {
                                #svg-card {
                                    display: block !important;
                                }

                            }

                            #svg-card {
                                display: none;
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

                                    @isset($first_name)
                                    <tspan class="cls-8" x="0" y="0">{{$first_name}}</tspan>
                                    @endisset
                                    @isset($last_name)
                                    <tspan x="0" y="18">{{$last_name}}</tspan>
                                    @endisset
                                </text>
                                @isset($file)
                                <image style="overflow:visible;" width="377" height="379" id="WORKER-IMG" xlink:href="{{$file->temporaryUrl()}}" transform="matrix(0.2535 0 0 0.2535 56.6439 30.8369)"></image>
                                @endisset
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
                                <image id="QR_Code_generationsav.com_stafflinks_" width="2255" height="2255" transform="translate(35.55 115.26) scale(.04)" xlink:href="{{ asset('assets/img/qr-code.png') }}" />
                                <rect id="Background_Color_333333_" class="back-3" width="155.52" height="114.26" />
                                <line id="White_Dash" class="back-1" x1="31.06" y1="108.64" x2="125" y2="108.64" />
                                {!! QrCode::size(25)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9') !!}
                            </g>
                        </svg>
                    </div>
                    <div id='end-buttons'>
                        @if(Auth::user())
                        <button class="btn btn-info btn-lg pull-right" type="button" onclick="printpart()" wire:click="is_loggedin">Print</button>
                        @endif
                        <button class="btn btn-danger nextBtn btn-lg pull-right " type="button" wire:click="back(2)">Back</button>
                        <button class="btn btn-success btn-lg pull-right " wire:click="submitForm" type="button">Finish!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printpart() {
            var printwin = window.open("");
            printwin.document.write(document.getElementById("svg-card").innerHTML);
            // printwin.stop();
            // printwin.print();
            // printwin.close();
        }
    </script>
</div>