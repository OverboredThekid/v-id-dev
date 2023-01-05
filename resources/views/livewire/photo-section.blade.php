<div>
    <button wire:click="capture" class="btn btn-primary mb-4">Capture</button>
    <input type="file" accept="image/*" wire:model="image" class="form-control mb-4">
    <button wire:click="upload" class="btn btn-primary mb-4">Upload</button>

    @if($capturedImage)
        <img src="{{ $capturedImage }}" alt="Captured Image" class="mb-4">
    @endif

    @if($uploadedImage)
        <img src="{{ $uploadedImage }}" alt="Uploaded Image" class="mb-4">
    @endif

    @if($croppedImage)
        <img src="{{ $croppedImage }}" alt="Cropped Image" class="mb-4">
    @endif

    @if($capturedImage || $uploadedImage)
        @include('livewire.photo-section-crop-modal')
    @endif
</div>
