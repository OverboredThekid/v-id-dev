<div>
    <div wire:ignore.self class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <!-- Webcam capture -->
                <div x-data="{ showWebcam: false }" class="mb-3">
                    <button class="btn btn-primary" @click="showWebcam = true">
                        Capture Photo
                    </button>
                    <div x-show="showWebcam" class="webcam-container mt-3">
                        <video x-ref="video" class="webcam"></video>
                        <button class="btn btn-primary mt-3" @click="capture()">Take Photo</button>
                    </div>
                </div>

                <!-- File upload -->
                <div class="mb-3">
                    <button class="btn btn-primary" wire:click="openFileInput">
                        Select Photo
                    </button>
                    <input wire:model="photo" type="file" wire:change="upload" class="hidden" />
                </div>

                <!-- Cropped image preview -->
                <div x-data="{ showCropper: false }" x-show="photo || showWebcam">
                    <img x-ref="image" class="mb-3" />
                    <button class="btn btn-primary" @click="showCropper = true">
                        Crop Photo
                    </button>
                    <div x-show="showCropper" x-init="initCropper()" class="cropper-container mt-3">
                        <img x-ref="cropper" class="cropper" />
                        <button class="btn btn-primary mt-3" @click="crop()">Crop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
