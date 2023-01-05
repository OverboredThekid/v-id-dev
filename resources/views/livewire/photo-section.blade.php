<div>
    <div wire:ignore class="cropper-container" id="cropperContainer" style="display: none;">
        <img wire:ignore class="cropper-image" id="cropperImage" />
        <div class="cropper-controls">
            <button wire:click="cropImage" class="btn btn-primary">Crop</button>
            <button wire:click="cancelCrop" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
    <div wire:ignore class="webcam-container" id="webcamContainer" style="display: none;">
        <video wire:ignore class="webcam-video" id="webcamVideo" autoplay></video>
        <canvas wire:ignore class="webcam-canvas" id="webcamCanvas"></canvas>
        <div class="webcam-controls">
            <button wire:click="captureImage" class="btn btn-primary">Capture</button>
            <button wire:click="cancelCapture" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
    <div wire:ignore class="upload-container" id="uploadContainer">
        <input type="file" wire:model="photo" class="form-control" id="photoInput" accept="image/*" />
        <button wire:click="showWebcam" class="btn btn-secondary">Capture Photo</button>
    </div>
    <div wire:ignore class="preview-container" id="previewContainer" style="display: none;">
        <img wire:ignore class="preview-image" id="previewImage" />
        <div class="preview-controls">
            <button wire:click="showCropper" class="btn btn-primary">Crop</button>
            <button wire:click="submit" class="btn btn-primary">Submit</button>
            <button wire:click="cancelPreview" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
    <script>
        function showElement(elementId) {
            document.getElementById(elementId).style.display = 'block';
        }

        function hideElement(elementId) {
            document.getElementById(elementId).style.display = 'none';
        }

        function dataURLtoFile(dataurl, filename) {
            var arr = dataurl.split(','),
                mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]),
                n = bstr.length,
                u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], filename, {
                type: mime
            });
        }

        function initWebcam() {
            Webcam.set({
                width: 480,
                height: 360,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#webcamVideo');
        }

        function initCropper() {
            var image = document.getElementById('cropperImage');
            var cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                responsive: true
            });
            window.cropper = cropper;
        }

        function destroyCropper() {
            window.cropper.destroy();
            window.cropper = null;
        }

        function captureImage() {
            Webcam.snap(function(data_uri) {
                var image = document.getElementById('webcamCanvas').getContext('2d').drawImage(document.getElementById('webcamVideo'), 0, 0, 480, 360);
                var file = dataURLtoFile(data_uri, 'photo.jpeg');
                @this.set('photo', file);
                hideElement('webcamContainer');
                showElement('uploadContainer');
            });
        }

        function cancelCapture() {
            hideElement('webcamContainer');
            showElement('uploadContainer');
        }

        function showWebcam() {
            initWebcam();
            hideElement('uploadContainer');
            showElement('webcamContainer');
        }

        function showCropper() {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cropperImage').src = e.target.result;
            };
            reader.readAsDataURL(@this.photo);
            initCropper();
            hideElement('previewContainer');
            showElement('cropperContainer');
        }

        function cropImage() {
            var croppedCanvas = window.cropper.getCroppedCanvas();
            var file = dataURLtoFile(croppedCanvas.toDataURL(), 'photo.jpeg');
            @this.set('photo', file);
            destroyCropper();
            hideElement('cropperContainer');
            showElement('previewContainer');
        }

        function cancelCrop() {
            destroyCropper();
            hideElement('cropperContainer');
            showElement('previewContainer');
        }

        function cancelPreview() {
            hideElement('previewContainer');
            showElement('uploadContainer');
        }

        function submit() {
            @this.call('submit');
        }

        document.getElementById('photoInput').addEventListener('change', function() {
            var file = this.files[0];
            @this.set('photo', file);
            hideElement('uploadContainer');
            showElement('previewContainer');
        });

        document.getElementById('previewImage').addEventListener('load', function() {
            this.style.height = 'auto';
            this.style.maxWidth = '100%';
        });
    </script>
    @endpush


</div>