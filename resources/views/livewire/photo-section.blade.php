<div>
    <div id="app" wire:ignore>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Photo Capture and Crop</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="my_camera"></div>
                                    <br>
                                    <button wire:click="capture()" class="btn btn-primary btn-block">Capture Photo</button>
                                </div>
                                <div class="col-md-6">
                                    <div id="results">Your captured photo will appear here...</div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="file" id="upload-photo" accept="image/*" wire:change="upload" class="d-none">
                                    <button wire:click="openFilePicker" class="btn btn-secondary btn-block">
                                        Choose Photo from Computer
                                    </button>
                                </div>
                            </div>
                            <br>
                            @if ($image)
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div id="uploaded-photo" class="image-container">
                                            <img wire:loading wire:target="upload" src="{{ $image }}" alt="your image" class="img-fluid" />
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button wire:click="crop" class="btn btn-primary btn-block">Crop Photo</button>
                                    </div>
                                </div>
                            @endif
                            @if ($croppedImage)
                                <div class="row mt-5">
                                    <div class="col-md-12 text-center">
                                        <div id="cropped-photo" class="image-container">
                                            <img src="{{ $croppedImage }}" alt="your cropped image" class="img-fluid" />
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button wire:click="save" class="btn btn-success btn-block">Save Photo</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let cropper;

    function showCroppedImage(img) {
        var image = document.createElement('img');
        image.src = img;
        var container = document.getElementById('cropped-photo');
        container.innerHTML = '';
        container.appendChild(image);
    }

    function capture() {
        webcam.capture(function (data_uri) {
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            let image = document.querySelector('#results img');
            image.setAttribute('id', 'captured-photo');
            cropper = new Cropper(image, {
                aspectRatio: 1,
                crop: function(event) {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                }
            });
        });
    }

    function crop() {
        let canvas = cropper.getCroppedCanvas();
        let image = canvas.toDataURL('image/jpeg', 0.8);
        showCroppedImage(image);
        window.livewire.emit('crop', image);
    }

    function openFilePicker() {
        document.getElementById('upload-photo').click();
    }

    window.livewire.on('upload', () => {
        let fileInput = document.getElementById('upload-photo');
        let file = fileInput.files[0];
        let reader = new FileReader();
        reader.onload = function () {
            let image = new Image();
            image.src = reader.result;
            image.setAttribute('id', 'uploaded-photo');
            let container = document.getElementById('uploaded-photo');
            container.innerHTML = '';
            container.appendChild(image);
            cropper = new Cropper(image, {
                aspectRatio: 1,
                crop: function(event) {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                }
            });
        };
        reader.readAsDataURL(file);
    });
</script>
