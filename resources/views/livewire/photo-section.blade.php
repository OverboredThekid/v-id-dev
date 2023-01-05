<div>
    <div>
        <div wire:ignore.self class="camera-container">
            <div class="capture-container" id="capture-container">
                <video wire:ignore.self class="camera-stream" id="camera-stream"></video>
                <div class="capture-overlay" id="capture-overlay"></div>
                <div class="capture-buttons" id="capture-buttons">
                    <button wire:click="openWebcam" class="btn btn-primary" id="btn-capture-webcam">Capture from Webcam</button>
                    <button wire:click="openFilePicker" class="btn btn-secondary" id="btn-upload-file">Upload from Computer</button>
                </div>
            </div>
            <input type="file" wire:model="image" class="image-input" accept="image/*" id="image-input">
        </div>
        @if($image)
            <div class="cropper-container" wire:ignore>
                <img src="{{ $image->temporaryUrl() }}" id="cropper-image">
                <div class="cropper-buttons" id="cropper-buttons">
                    <button wire:click="cropImage" class="btn btn-primary" id="btn-crop-image">Crop Image</button>
                    <button wire:click="reset" class="btn btn-secondary" id="btn-reset">Start Over</button>
                </div>
            </div>
        @endif
        @if($croppedImage)
            <div class="cropped-image-container" wire:ignore>
                <img src="{{ $croppedImage->temporaryUrl() }}" class="cropped-image">
                <button wire:click="submit" class="btn btn-primary" id="btn-submit">Submit</button>
            </div>
        @endif
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.7.0/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.6/dist/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.25/webcam.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script>
        function getCroppedImageData() {
            const canvas = document.createElement('canvas');
            const displayScale = window.devicePixelRatio;
            const displayWidth = Math.floor(document.querySelector('.cropper-container').offsetWidth * displayScale);
            const displayHeight = Math.floor(document.querySelector('.cropper-container').offsetHeight * displayScale);
            canvas.width = displayWidth;
            canvas.height = displayHeight;
            canvas.getContext('2d').scale(displayScale, displayScale);
            cropper.getCroppedCanvas().toBlob((blob) => {
                const formData = new FormData();
                formData.append('cropped_image', blob);
                $.ajax({
                    url: '{{ route('livewire.photo-section.crop-image') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (response) => {
                        window.livewire.emit('croppedImageUploaded', response.path);
                    },
                });
            });
        }

        let cropper;
        let webcam;
        let webcamStarted = false;

        document.querySelector('#btn-capture-webcam').addEventListener('click', () => {
            document.querySelector('#capture-container').style.display = 'none';
            webcam = new Webcam(document.querySelector('#camera-stream'));
            webcam.set({
                width: 1280,
                height: 720,
                dest_width: 1280,
                dest_height: 720,
                image_format: 'jpeg',
                jpeg_quality: 90,
            });
            webcam.attach();
            webcamStarted = true;
        });

        document.querySelector('#image-input').addEventListener('change', () => {
            const file = document.querySelector('#image-input').files[0];
            if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
        document.querySelector('#cropper-image').src = e.target.result;
        cropper = new Cropper(document.getElementById('cropper-image'), {
            aspectRatio: 1,
            viewMode: 2,
            crop(event) {
                console.log(event.detail.x);
                console.log(event.detail.y);
                console.log(event.detail.width);
                console.log(event.detail.height);
                console.log(event.detail.rotate);
                console.log(event.detail.scaleX);
                console.log(event.detail.scaleY);
            },
        });
    };
    reader.readAsDataURL(file);
}
</script>
                           

</div>
