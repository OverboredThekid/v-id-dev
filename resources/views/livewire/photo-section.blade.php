<div>
<div class="photo-section">
    <div class="webcam-container" x-data="{ open: false }">
        <button x-on:click="open = true; startWebcam">
            Take a Photo
        </button>
        <div x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="overlay" x-on:click.away="open = false; stopWebcam"></div>
            <div class="modal" x-on:click.away="open = false; stopWebcam">
                <div id="webcam"></div>
                <button class="btn btn-primary" x-on:click="takeSnapshot">
                    Take Photo
                </button>
            </div>
        </div>
    </div>

    <div class="upload-container" x-data="{ open: false }">
        <button x-on:click="open = true">
            Upload a Photo
        </button>
        <input type="file" x-show="open" x-on:change="open = false" wire:model="photo" />
    </div>

    @if($photo)
        <div class="cropper-container">
            <img id="photo" src="{{ $photo->temporaryUrl() }}" />
        </div>
        <button class="btn btn-primary" wire:click="cropPhoto">
            Crop Photo
        </button>
    @endif

    @if($croppedPhoto)
        <img src="{{ $croppedPhoto }}" />
        <button class="btn btn-primary" wire:click="submitPhoto">
            Submit Photo
        </button>
    @endif
</div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.x.x/dist/cropper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.x.x/webcam.min.js" defer></script>
    <script>
        function startWebcam() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#webcam');
        }

        function stopWebcam() {
            Webcam.reset();
        }

        function takeSnapshot() {
            Webcam.snap(function(dataUri) {
                document.getElementById('photo').src = dataUri;
            });
        }

        function cropPhoto() {
            var image = document.getElementById('photo');
            var cropper = new Cropper(image, {
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

            cropper.getCroppedCanvas().toBlob((blob) => {
                const formData = new FormData();
                formData.append('cropped_photo', blob);
                @this.call('cropPhoto', formData);
            });
        }
    </script>
</div>
