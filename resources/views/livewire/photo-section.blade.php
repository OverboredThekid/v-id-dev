<div>
    <div wire:ignore>
        <input type="file" id="fileInput" class="hidden" accept="image/*" wire:model="photo">
        <button id="captureButton" type="button" class="btn btn-primary" wire:click="capture()">Capture</button>
        <button id="uploadButton" type="button" class="btn btn-secondary" wire:click="$refresh()">Upload</button>
        <div id="webcam" style="display:none;"></div>
    </div>
    <div wire:loading wire:target="upload" class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <div wire:ignore>
        <img id="capturedImage" src="" style="display:none;">
    </div>
    @if ($photo)
        <div wire:ignore>
            <div id="cropperContainer"></div>
            <button id="cropButton" type="button" class="btn btn-success" wire:click="crop()">Crop</button>
        </div>
        <img src="{{ $croppedPhoto }}" id="croppedImage" style="display:none;">
    @endif
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x/dist/alpine.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.6/dist/cropper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.25/webcam.min.js" defer></script>
    <script>
        window.addEventListener('load', function () {
            var captureButton = document.getElementById('captureButton');
            var uploadButton = document.getElementById('uploadButton');
            var fileInput = document.getElementById('fileInput');
            var capturedImage = document.getElementById('capturedImage');
            var cropperContainer = document.getElementById('cropperContainer');
            var cropButton = document.getElementById('cropButton');
            var croppedImage = document.getElementById('croppedImage');

            captureButton.addEventListener('click', function () {
                Webcam.snap(function (dataUri) {
                    capturedImage.src = dataUri;
                    capturedImage.style.display = 'block';
                    fileInput.value = null;
                });
            });

            uploadButton.addEventListener('click', function () {
                fileInput.click();
            });

            fileInput.addEventListener('change', function () {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        capturedImage.src = e.target.result;
                        capturedImage.style.display = 'block';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            @if ($photo)
                var cropper = new CropperJS(capturedImage, {
                    aspectRatio: 1,
                    crop: function () {
                        cropButton.style.display = 'block';
                    }
                });
                cropperContainer.appendChild(cropper.getCropperElement());
            @endif

            cropButton.addEventListener('click', function () {
                cropper.getCroppedCanvas().toBlob(function (blob) {
                    croppedImage.src = URL.createObjectURL(blob);
                    croppedImage.style.display = 'block';
                });
                cropButton.style.display = 'none';
            });
        });
    </script>
@endsection

</div>
