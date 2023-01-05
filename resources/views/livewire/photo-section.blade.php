<div>
    <!-- Button to trigger the photo capture or upload -->
    <button wire:click="openCaptureModal">Capture Photo</button>
    <button wire:click="openUploadModal">Upload Photo</button>

    <!-- Modal to capture a photo from the webcam -->
    <div wire:ignore wire:model="captureModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Capture Photo</h2>
                <button wire:click="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Webcam element -->
                <div id="webcam"></div>
                <!-- Button to take the photo -->
                <button wire:click="capturePhoto">Take Photo</button>
            </div>
        </div>
    </div>

    <!-- Modal to upload a photo from the computer -->
    <div wire:ignore wire:model="uploadModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Upload Photo</h2>
                <button wire:click="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- File input element -->
                <input type="file" wire:model="photo" />
                <!-- Button to select the file -->
                <button wire:click="uploadPhoto">Select Photo</button>
            </div>
        </div>
    </div>

    <!-- Modal to crop the photo -->
    <div wire:ignore wire:model="cropModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Crop Photo</h2>
                <button wire:click="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Image element to display the photo -->
                <img id="photo" />
                <!-- Button to submit the cropped photo -->
                <button wire:click="submitPhoto">Submit</button>
            </div>
        </div>
    </div>
</div>
