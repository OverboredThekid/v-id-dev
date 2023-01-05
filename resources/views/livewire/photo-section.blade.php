<div class="photo-section">
    <div class="webcam-container">
        <!-- Webcam.js component to capture photo -->
        <div id="my_camera"></div>
        <div class="capture-buttons">
            <!-- Button to capture photo -->
            <button class="btn btn-primary" onclick="take_snapshot()">Capture Photo</button>
            <!-- Button to select photo from file system -->
            <button class="btn btn-secondary" wire:click="$emit('photoSelected')">Select from Computer</button>
        </div>
    </div>
    <!-- File input to select photo from file system -->
    <input type="file" wire:model="photo" accept="image/*" style="display:none" />
    <!-- Cropper.js component to crop photo -->
    <div class="cropper-container" style="display:none">
        <img wire:model="photo" id="cropper-image" />
        <div class="crop-buttons">
            <!-- Button to crop photo -->
            <button class="btn btn-primary" wire:click="cropPhoto">Crop Photo</button>
            <!-- Button to submit photo -->
            <button class="btn btn-secondary" wire:click="submitPhoto">Submit</button>
        </div>
    </div>
<!-- Include Alpine.js, Webcam.js, and Cropper.js libraries -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.25/webcam.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js" defer></script>
<!-- Use Alpine.js to toggle between webcam and cropper components -->
<script>
    window.addEventListener('photoSelected', () => {
        document.querySelector('.webcam-container').style.display = 'none';
        document.querySelector('.cropper-container').style.display = 'block';
    });

    // Webcam.js initialization and snapshot function
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');
    function take_snapshot() {
        Webcam.snap((data_uri) => {
            document.querySelector('#cropper-image').src = data_uri;
            document.querySelector('.webcam-container').style.display = 'none';
            document.querySelector('.cropper-container').style.display = 'block';
        });
    }
</script>
</div>
