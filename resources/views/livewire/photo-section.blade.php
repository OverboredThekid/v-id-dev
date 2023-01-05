<div>
    <div class="flex justify-center mt-4">
        <button wire:click="openWebcam" class="btn btn-primary" onclick="initWebcam()">
            Take Photo
        </button>
        <button wire:click="openFileInput" class="btn btn-primary ml-2">
            Select Photo
        </button>
    </div>

    @if($showWebcam)
        <div class="mt-4">
            <webcam wire:model="photo"></webcam>
            <div class="flex justify-center mt-4">
                <button wire:click="capture" class="btn btn-primary">
                    Capture
                </button>
                <button wire:click="cancelWebcam" class="btn btn-secondary ml-2">
                    Cancel
                </button>
            </div>
        </div>
    @endif

    @if($showFileInput)
        <div class="mt-4">
            <input type="file" wire:model="photo" />
            <div class="flex justify-center mt-4">
                <button wire:click="submit" class="btn btn-primary">
                    Select
                </button>
                <button wire:click="cancelFileInput" class="btn btn-secondary ml-2">
                    Cancel
                </button>
            </div>
        </div>
    @endif

    @if($photo)
        <div class="mt-4">
            <img wire:click="openCropper" src="{{ $photo->temporaryUrl() }}" alt="Photo" class="w-full" />
        </div>
        <div wire:ignore class="modal" x-data="{ open: {{ $showCropper ? 'true' : 'false' }} }" @keydown.escape="open = false">
            <div class="modal-overlay" x-show="open" x-on:click.away="open = false"></div>
            <div class="modal-container" x-show="open">
                <div class="modal-header">
                    <button class="modal-close" x-on:click="open = false">&times;</button>
                </div>
                <div class="modal-body p-4">
                    <cropper :src="'{{ $photo->temporaryUrl() }}'" wire:model="croppedPhoto"></cropper>
                </div>
                <div class="modal-footer">
                    <button wire:click="submit" class="btn btn-primary">
                        Crop and Save
                    </button>
                    <button wire:click="cancelCropper" class="btn btn-secondary ml-2">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
    @push('scripts')
   <script>
        function initWebcam() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('webcam');
        }

        function capture() {
            Webcam.snap(function(dataUri) {
                @this.set('photo', dataUri);
                @this.set('showWebcam', false);
            });
        }
    </script>
@endpush

</div>
