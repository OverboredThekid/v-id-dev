<div>
<div>
    <div class="form-group">
        <button wire:click="capturePhoto" class="btn btn-primary">Capture Photo</button>
        <button wire:click="uploadPhoto" class="btn btn-secondary">Upload Photo</button>
    </div>
    @if($capturing)
        <div wire:ignore>
            <video id="webcam" autoplay></video>
        </div>
        <div class="form-group">
            <button wire:click="submitPhoto" class="btn btn-primary">Submit</button>
            <button wire:click="cancelCapture" class="btn btn-secondary">Cancel</button>
        </div>
    @elseif($uploading)
        <div wire:ignore>
            <input type="file" id="photoUpload" />
        </div>
        <div class="form-group">
            <button wire:click="submitPhoto" class="btn btn-primary">Submit</button>
            <button wire:click="cancelUpload" class="btn btn-secondary">Cancel</button>
        </div>
    @elseif($cropping)
        <img id="croppedImage" src="{{ $croppedImage }}" />
        <div wire:ignore>
            <div id="cropper"></div>
        </div>
        <div class="form-group">
            <button wire:click="submitPhoto" class="btn btn-primary">Submit</button>
            <button wire:click="cancelCrop" class="btn btn-secondary">Cancel</button>
        </div>
    @elseif($submitting)
        <div class="form-group">
            <button wire:click="confirmSubmit" class="btn btn-primary">Confirm</button>
            <button wire:click="cancelSubmit" class="btn btn-secondary">Cancel</button>
        </div>
    @endif
</div>
@push('scripts')
<script>
window.livewire.on('captureSuccess', () => {
const video = document.getElementById('webcam');
let canvas = document.createElement('canvas');
canvas.width = video.videoWidth;
canvas.height = video.videoHeight;
canvas.getContext('2d').drawImage(video, 0, 0);
let data = canvas.toDataURL('image/png');
let image = document.createElement('img');
image.src = data;
document.getElementById('cropper').appendChild(image);
let cropper = new Cropper(image, {
aspectRatio: 1,
viewMode: 2,
crop(event) {
let dataUrl = cropper.getCroppedCanvas().toDataURL();
window.livewire.emit('croppedImage', dataUrl);
}
});
});
</script>
@endpush
</div>