<div>
  <button wire:click="showCaptureModal" class="capture-button">Capture</button>
  <button wire:click="showUploadModal" class="upload-button">Upload</button>

  @if ($showCaptureModal)
    <div class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h2>Capture Photo</h2>
          <button wire:click="hideModal" class="close-button">&times;</button>
        </div>
        <div class="modal-body">
          <div class="capture-container">
            <canvas wire:model="capturedImage" width="640" height="480"></canvas>
            <div class="capture-controls">
              <video wire:model="video" width="640" height="480" autoplay></video>
              <button wire:click="captureImage" class="capture-button">Capture</button>
            </div>
          </div>
          <div class="cropper-container" wire:ignore>
            <img wire:model="croppedImage" alt="Cropped image">
            <div class="cropper-controls">
              <button wire:click="submitImage" class="submit-button">Submit</button>
              <button wire:click="cancelCrop" class="cancel-button">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

  @if ($showUploadModal)
    <div class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h2>Upload Photo</h2>
          <button wire:click="hideModal" class="close-button">&times;</button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="uploadImage" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*" wire:model="uploadedImage">
            <button type="submit" class="upload-button">Upload</button>
          </form>
          <div class="cropper-container" wire:ignore>
            <img wire:model="croppedImage" alt="Cropped image">
            <div class="cropper-controls">
              <button wire:click="submitImage" class="submit-button">Submit</button>
              <button wire:click="cancelCrop" class="cancel-button">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
