<div>
<div wire:ignore class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ $capturedImage ?? $uploadedImage }}" alt="Image to Crop" id="image-to-crop">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="$refresh">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click="crop">Crop</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.7.0/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.7.9/dist/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.25/webcam.min.js"></script>
    <script>
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        function showModal() {
            $('div.modal').modal('show');
        }

        function hideModal() {
            $('div.modal').modal('hide');
        }

        function takeSnapshot() {
            Webcam.snap(function (dataUri) {
                let raw_image_data = dataUri.replace(/^data\:image\/\w+\;base64\,/, '');
                let formData = new FormData();
                formData.append('image', raw_image_data);

                axios.post("{{ route('livewire.photo-section.capture') }}", formData).then(response => {                    console.log(response);
                }).catch(error => {
                    console.log(error);
                });
            });
        }

        function showSnapshotButton() {
            $('button#take-snapshot').removeClass('hidden');
        }

        function hideSnapshotButton() {
            $('button#take-snapshot').addClass('hidden');
        }

        function showVideo() {
            $('#my_camera').removeClass('hidden');
        }

        function hideVideo() {
            $('#my_camera').addClass('hidden');
        }

        let image = document.getElementById('image-to-crop');
        let cropper;

        function initializeCropper() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                dragMode: 'move',
                rotatable: false,
                scalable: false,
                zoomable: false,
                crop(event) {
                    document.getElementById('x').value = event.detail.x;
                    document.getElementById('y').value = event.detail.y;
                    document.getElementById('width').value = event.detail.width;
                    document.getElementById('height').value = event.detail.height;
                }
            });
        }

        $(document).ready(function () {
            Webcam.attach('#my_camera');

            window.livewire.on('showModal', function () {
                hideSnapshotButton();
                hideVideo();
                showModal();
                initializeCropper();
            });

            window.livewire.on('hideModal', function () {
                showSnapshotButton();
                showVideo();
                hideModal();
                cropper.destroy();
            });
        });
    </script>
@endpush
</div>