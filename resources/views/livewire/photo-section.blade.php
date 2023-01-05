<div>
    <button wire:click="showCaptureModal" class="btn btn-primary">Capture Photo</button>
    <button wire:click="showUploadModal" class="btn btn-primary">Upload Photo</button>
</div>

<!-- Capture Modal -->
<div wire:ignore.self class="modal fade" id="captureModal" tabindex="-1" role="dialog" aria-labelledby="captureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="captureModalLabel">Capture Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="captureContainer">
                    <canvas id="captureCanvas"></canvas>
                    <div>
                        <button wire:click="takePhoto" class="btn btn-primary">Take Photo</button>
                    </div>
                </div>
                <div id="cropperContainer" style="display:none;">
                    <div id="cropper"></div>
                    <div>
                        <button wire:click="cancelCrop" class="btn btn-secondary">Cancel</button>
                        <button wire:click="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div wire:ignore.self class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="uploadContainer">
                    <input type="file" wire:model="photo" />
                </div>
                <div id="cropperContainer" style="display:none;">
                    <div id="cropper"></div>
                    <div>
                        <button wire:click="cancelCrop" class="btn btn-secondary">Cancel</button>
                        <button wire:click="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.7.0/dist/alpine.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@2.3.4/dist/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/webcamjs@1.0.25/webcam.min.js"></script>
<script>
    function showCropper() {
        document.getElementById('captureContainer').style.display = 'none';
        document.getElementById('cropperContainer').style.display = 'block';

        var image = document.getElementById('captureCanvas').toDataURL();
        var cropper = new Cropper(document.getElementById('cropper'), {
            aspectRatio: 1,
            crop(event) {
                // Output the result data for cropping image.
                console.log(event.detail.x);
                console.log(event.detail.y);
                console.log(event.detail.width);
                console.log(event.detail.height);
                console.log(event.detail.rotate);
                console.log(event.detail.scaleX);
                console.log(event.detail.scaleY);
            },
        });
        cropper.replace(image);
    }

    function hideCropper() {
        document.getElementById('captureContainer').style.display = 'block';
        document.getElementById('cropperContainer').style.display = 'none';
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

    function takePhoto() {
        Webcam.snap(function(data_uri) {
            document.getElementById('captureCanvas').getContext('2d').drawImage(data_uri, 0, 0, 400, 300);
            showCropper();
        });
    }
</script>
@endpush