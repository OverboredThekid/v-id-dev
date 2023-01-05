<div>
    <button wire:click="showCaptureModal" class="btn btn-primary">Capture Photo</button>
    <button wire:click="showUploadModal" class="btn btn-secondary">Upload Photo</button>
</div>

<!-- Capture Modal -->
<div wire:ignore.self wire:model="captureModalOpen" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Capture Photo</h5>
                <button wire:click="hideCaptureModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="capture-container" class="text-center" style="height: 400px;">
                            <webcam wire:model="capturedImage" wire:photo.taken="photoTaken" wire:photo.saved="photoSaved" wire:photo.error="photoError" class="w-100 h-100"></webcam>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click="hideCaptureModal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button wire:click="takePhoto" class="btn btn-primary">Take Photo</button>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div wire:ignore.self wire:model="uploadModalOpen" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Photo</h5>
                <button wire:click="hideUploadModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form wire:submit.prevent="uploadPhoto">
                            <div class="form-group">
                                <label for="photo">Select Photo</label>
                                <input type="file" wire:model="uploadedPhoto" class="form-control" id="photo" accept="image/*">
                                @error('uploadedPhoto') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Crop Modal -->
<div wire:ignore.self wire:model="cropModalOpen" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Photo</h5>
                <button wire:click="hideCropModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="crop-container" class="text-center" style="height: 400px;">
                            <img wire:model="croppedImage" id="cropped-image" class="w-100 h-100" src="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click="hideCropModal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button wire:click="cropAndSubmit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.7/dist/cropper.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.25/webcam.min.js" defer></script>
@endpush