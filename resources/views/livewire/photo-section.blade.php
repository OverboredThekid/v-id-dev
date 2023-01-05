<div>
    @if (!$uploaded)
        <div class="webcam-container">
            <div id="my_camera"></div>
            <div class="capture-container">
                <button wire:click="capture" class="btn btn-primary">Capture</button>
            </div>
        </div>

        <input type="hidden" wire:model="photoUrl">
    @elseif (!$cropped)
        <div id="cropper"></div>
        <input type="hidden" wire:model="croppedPhotoUrl">
        <button wire:click="crop" class="btn btn-primary">Crop</button>
    @else
        <img src="{{ $croppedPhotoUrl }}" class="img-fluid">
        <button wire:click="submit" class="btn btn-primary">Submit</button>
    @endif
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x.x/dist/alpine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.x.x/dist/cropper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.x.x/webcam.min.js"></script>

    <script>
        // Initialize webcam
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');

        function takeSnapshot() {
            // Take snapshot and get image data
            Webcam.snap(function(data_uri) {
                // Set the image url
                window.livewire.emit('photoUrl', data_uri);
            });
        }

        // Initialize cropper
        window.addEventListener('load', function() {
            var image = document.getElementById('cropper');
            var cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                rotatable: false,
                zoomable: false,
                scalable: false,
                crop: function(event) {
                    window.livewire.emit('croppedPhotoUrl', cropper.getCroppedCanvas().toDataURL());
                }
            });
        });
    </script>
@endpush
