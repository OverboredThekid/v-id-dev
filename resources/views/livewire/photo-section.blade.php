<div>
<div>
  @if ($photo)
    <img src="{{ $photo }}" alt="Captured photo">
  @else
    <button wire:click="capture" class="btn btn-primary">Capture Photo</button>
    <button wire:click="upload" class="btn btn-primary">Upload Photo</button>
  @endif
</div>

<!-- Modal for cropping -->
<div wire:ignore class="modal" id="cropModal">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Crop Photo</h5>
      <button wire:click="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
    <div class="modal-body">
      <div class="cropper-container">
        <img wire:model="photo" id="cropper">
      </div>
    </div>
    <div class="modal-footer">
      <button wire:click="crop" type="button" class="btn btn-primary">Submit</button>
    </div>
  </div>
</div>
@push('scripts')
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.4/dist/cropper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.0/webcam.min.js"></script>
  <script>
    // Initialize cropper
    let cropper;
    let image = document.getElementById('cropper');

    function initCropper() {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 2,
        dragMode: 'crop',
        background: false,
      });
    }

    // Close modal and reset cropper
    function closeModal() {
      $('#cropModal').modal('hide');
      cropper.destroy();
      cropper = null;
    }

    // Capture photo using webcam
    function capture() {
      Webcam.set({
        width: 400,
        height: 400,
        image_format: 'jpeg',
        jpeg_quality: 90
      });
      Webcam.attach('#cropper');
    }

    // Set photo from file input
    function upload() {
      $('#photoInput').click();
    }

    // Set photo from file input
    $('#photoInput').change(function () {
      const file = this.files[0];
      const reader = new FileReader();

      reader.addEventListener('load', function () {
        image.src = reader.result;
        initCropper();
        $('#cropModal').modal('show');
      });

      reader.readAsDataURL(file);
    });
  </script>
@endpush

<!-- Hidden file input for uploading photos -->
<input type="file" wire:ignore id="photoInput" accept="image/*">

</div>