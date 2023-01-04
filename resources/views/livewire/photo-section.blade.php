<div>
<div>
    @if ($photo)
        <img src="{{ $photo }}" alt="Your Photo" class="w-full">
    @else
        <div class="text-center py-5">
            <h3 class="text-gray-600">Take a photo or upload one from your computer</h3>
            <button wire:click="openCamera" class="btn btn-primary mt-5">Take Photo</button>
            <button wire:click="openFileInput" class="btn btn-secondary mt-5">Upload Photo</button>
        </div>
    @endif

    <input type="file" wire:model="photo" class="hidden">

    @if ($showCamera)
        <div class="relative mt-10">
            <video wire:model="video" class="w-full"></video>
            <button wire:click="capture" class="absolute bottom-0 right-0 mb-5 mr-5 btn btn-primary rounded-full p-3">
                <i class="fas fa-camera"></i>
            </button>
            <button wire:click="closeCamera" class="absolute top-0 left-0 mt-5 ml-5 btn btn-secondary rounded-full p-3">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
</div>

@if ($photo)
    <div class="mt-10">
        <button wire:click="crop" class="btn btn-primary mr-3">Crop</button>
        <button wire:click="submit" class="btn btn-success">Submit</button>
    </div>
@endif

</div>