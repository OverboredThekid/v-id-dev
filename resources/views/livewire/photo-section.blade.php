<div>
    <div>
        @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" alt="Photo" class="w-full h-64 object-cover rounded-md">
        @else
            <div class="relative h-64 rounded-md">
                <div class="p-5">
                    <button wire:click="capture()" class="btn btn-gray-400 rounded-full shadow-md hover:shadow-lg focus:outline-none focus:shadow-outline-gray active:shadow-outline-gray">
                        <svg class="h-12 w-12" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </button>
                </div>
                <div wire:loading wire:target="capture" class="spinner top-0 left-0 m-auto"></div>
            </div>
        @endif
    </div>
    @if ($photo)
        <div class="mt-5">
            <button wire:click="crop()" class="btn btn-gray-400 rounded-full shadow-md hover:shadow-lg focus:outline-none focus:shadow-outline-gray active:shadow-outline-gray">
                <svg class="h-12 w-12" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </button>
            <button wire:click="remove()" class="btn btn-gray-400 rounded-full shadow-md hover:shadow-lg focus:outline-none focus:shadow-outline-gray active:shadow-outline-gray ml-5">
                <svg class="h-12 w-12" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </div>
    @endif
</div>

@if ($cropping)
    <div class="relative h-64 mt-5 rounded-md" x-data="{ cropper: null }" x-init="cropper = new Cropper(this.querySelector('img'), { aspectRatio: 1, viewMode: 1, dragMode: 'move', crop: () => { $wire.cropped(cropper.getData()) } })">
        <div class="p-5">
            <button wire:click="capture()" class="btn btn-gray-400 rounded-full shadow-md hover:shadow-lg focus:outline-none focus:shadow-outline-gray active:shadow-outline-gray">
                <svg class="h-12 w-12" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </button>
            <button wire:click="save()" class="btn btn-gray-400 rounded-full shadow-md hover:shadow-lg focus:outline-none focus:shadow-outline-gray active:shadow-outline-gray ml-5">
                <svg class="h-12 w-12" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.04-.133-2.052-.382-3.016z"></path></svg>
            </button>
        </div>
        <img src="{{ $photo->temporaryUrl() }}" alt="Photo" class="w-full h-64 object-cover rounded-md">
    </div>
@endif
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@2.3.5/dist/cropper.min.js"></script>
