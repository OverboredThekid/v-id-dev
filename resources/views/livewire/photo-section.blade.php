<div>
    <!-- Capture photo button -->
    <button wire:click="capturePhoto" class="btn btn-primary">
        Capture Photo
    </button>

    <!-- File input for uploading a photo -->
    <input type="file" wire:model="photo" class="d-none" accept="image/*">

    <!-- Button for uploading a photo from the user's computer -->
    <button wire:click="$refresh" class="btn btn-primary">
        Upload Photo
    </button>

    <!-- Display the captured/uploaded photo -->
    @if($photo)
        <img wire:click="$refresh" src="{{ $photo->temporaryUrl() }}" alt="Captured photo" class="w-100 mt-3">
    @endif

    <!-- The cropper modal -->
    <div class="modal" tabindex="-1" role="dialog" wire:ignore>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- The cropper element -->
                    <div id="cropper"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button wire:click="cropPhoto" class="btn btn-primary">Crop</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit button -->
    <button class="btn btn-primary mt-3" wire:click="submit">
        Submit
    </button>
    @push('scripts')
    <!-- Include the alpine.js and webcam.js libraries -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.25/webcam.min.js"></script>

    <!-- Include the cropper.js library -->
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.6/dist/cropper.min.js"></script>

    <script>
        // Initialize the webcam
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#cropper');

        // Initialize the cropper
        var cropper = new Cropper(document.getElementById('cropper'), {
            aspectRatio: 1,
            viewMode: 1,
            scalable: false,
            zoomable: false,
            rotatable: false,
            crop: function(e) {
                // Save the cropped image data to a hidden input
                document.querySelector('input[name=cropped_image]').value = e.detail;
            }
        });

        // Capture a photo with the webcam
        function capturePhoto() {
            Webcam.snap(function(dataUri) {
                // Set the cropper image to the captured photo
                cropper.replace(dataUri);

                // Show the cropper modal
                $('#cropperModal').modal('show');
            });
        }
    </script>
@endpush
</div>