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
        <!-- Photo ID Section of the form -->
        <div class="row setup-content  {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3> Step 2</h3>

                    <div class="form-group img-upload">
                        @livewire('PhotoSection')
                    </div>

                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
                </div>
            </div>
        </div>
        <!-- End of Photo ID Section -->
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
                        <tr>
                            <td>Photo:</td>
                            <td>@if($imageData)
                                <img src="{{ $imageData }}" />
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div id='end-buttons'>
                    @if(Auth::user())
                    <button class="btn btn-info btn-lg pull-right" type="button" wire:click="is_loggedin">Print</button>
                    <script>
                        window.addEventListener('open-new-tab', event => {
                            window.open(event.detail, '_blank');
                        });
                    </script>
                    @endif
                    <button class="btn btn-danger nextBtn btn-lg pull-right " type="button" wire:click="back(2)">Back</button>
                    <button class="btn btn-success btn-lg pull-right " wire:click="submitForm" type="button">Finish!</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.livewire.on('sendBase64Image', (data) => {
        // Call the 'sendBase64Image' method on the component with the image data as an argument
        @this.call('sendBase64Image', data)
    });
</script>
</div>