<div>
    <div wire:ignore>
        <button wire:click="showCaptureForm">Capture</button>
        <button wire:click="showUploadForm">Upload</button>
    </div>
    <div wire:ignore wire:loading.class="hidden">
        @if ($showCaptureForm)
        <div wire:ignore>
            <canvas id="captureCanvas"></canvas>
            <button x-data x-on:click="capturePhoto()">Capture</button>
        </div>
        @endif
        @if ($showUploadForm)
        <div wire:ignore>
            <input type="file" wire:model="photo" accept="image/*">
        </div>
        @endif
        @if ($photo)
        <div>
            <img id="photoPreview" src="{{ $photo->temporaryUrl() }}">
        </div>
        <div wire:ignore>
            <button wire:click="openCropModal">Crop</button>
        </div>
        <div wire:ignore wire:model="showCropModal">
            <div>
                <img id="croppedPhotoPreview" src="{{ $croppedPhotoUrl }}">
            </div>
            <div>
                <button wire:click="submitPhoto">Submit</button>
                <button wire:click="closeCropModal">Cancel</button>
            </div>
        </div>
        @endif
    </div>
    @push('scripts')
    <script>
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#captureCanvas');

        function capturePhoto() {
            Webcam.snap(function(data_uri) {
                window.livewire.emit('photoCaptured', data_uri);
            });
        }
    </script>
    @endpush
</div>