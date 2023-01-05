<div>
    <div wire:ignore>
        <button wire:click="openCaptureModal" class="capture-button">Capture Photo</button>
        <button wire:click="openUploadModal" class="upload-button">Upload Photo</button>
    </div>

    <!-- Capture Modal -->
    <div wire:ignore class="modal" x-data x-init="cropper = null" x-bind:class.hidden="{{ $showCaptureModal ? 'hidden' : '' }}">
        <div class="modal-overlay" @click.stop="showCaptureModal = false"></div>
        <div class="modal-container">
            <div class="modal-header">
                <h2 class="modal-title">Capture Photo</h2>
                <button class="modal-close" @click.stop="showCaptureModal = false">&times;</button>
            </div>
            <div class="modal-body">
                <div class="capture-container">
                    <webcam wire:model="capture" />
                    <button wire:click="captureImage" class="capture-button">Capture</button>
                </div>
                <div class="cropper-container" x-bind:class.hidden="!showCropper">
                    <img wire:model="croppedImage" x-ref="cropperImage" />
                    <button wire:click="resetForm" class="cancel-button">Cancel</button>
                    <button wire:click="submitForm" class="submit-button">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div wire:ignore class="modal" x-data x-init="cropper = null" x-bind:class.hidden="!showUploadModal">
        <div class="modal-overlay" @click.stop="showUploadModal = false"></div>
        <div class="modal-container">
            <div class="modal-header">
                <h2 class="modal-title">Upload Photo</h2>
                <button class="modal-close" @click.stop="showUploadModal = false">&times;</button>
            </div>
            <div class="modal-body">
                <div class="upload-container">
                    <input type="file" wire:model="upload" />
                    <button wire:click="uploadImage" class="upload-button">Upload</button>
                </div>
                <div class="cropper-container" x-bind:class.hidden="!showCropper">
                    <img wire:model="croppedImage" x-ref="cropperImage" />
                    <button wire:click="resetForm" class="cancel-button">Cancel</button>
                    <button wire:click="submitForm" class="submit-button">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    function initCropper() {
        const image = document.querySelector('[x-ref="cropperImage"]');
        const options = {
            aspectRatio: 1,
            zoomable: false,
            rotatable: false,
            scalable: false,
            crop(event) {
                // Update the cropped image data
                livewire.set('croppedImage', event.detail.canvas.toDataURL());
            }
        };

        // Initialize Cropper.js
        window.cropper = new Cropper(image, options);
    }

    window.addEventListener('livewire:load', () => {
        // Initialize Cropper.js when the Livewire component is loaded
        initCropper();
    });

    window.addEventListener('livewire:unload', () => {
        // Destroy Cropper.js when the Livewire component is unloaded
        window.cropper.destroy();
        window.cropper = null;
    });
</script>
@endpush