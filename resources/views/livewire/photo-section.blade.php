<div>
    @if ($cropping)
        <div x-data="{ cropper: null }">
            <img src="{{ $photo }}" x-ref="photo" class="w-full h-64 object-cover" />

            <button wire:click="crop" class="btn btn-blue mt-4" x-on:click="cropper = new Cropper(photo, { aspectRatio: 16 / 9, crop(event) { [event.detail.x, event.detail.y, event.detail.width, event.detail.height].forEach((value, index) => window.livewire.emit('x', value)) } })">
                Crop
            </button>
        </div>
    @elseif ($croppedPhoto)
        <img src="{{ $croppedPhoto }}" class="w-full h-64 object-cover" />

        <button wire:click="submit" class="btn btn-blue mt-4">
            Submit
        </button>
    @else
        <webcam class="w-full h-64 object-cover" wire:model="photo" />

        <button wire:click="capture" class="btn btn-blue mt-4">
            Capture
        </button>

        <input type="file" wire:model="photo" class="hidden" />
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
