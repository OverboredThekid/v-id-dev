<div>
    <div wire:ignore.self class="image-container">
        @if ($photo)
            <img src="{{ $photo }}" alt="Your Photo">
        @endif
    </div>
    <div class="btn-container">
        @if (!$photo)
            <button wire:click="openCamera" class="btn btn-primary">
                Take Photo
            </button>
            <input type="file" wire:model="photo" accept="image/*" class="d-none">
            <button wire:click="$refresh" class="btn btn-secondary">
                Choose From Computer
            </button>
        @else
            <button wire:click="resetpage" class="btn btn-secondary">
                Choose Different Photo
            </button>
            <button wire:click="crop" class="btn btn-primary">
                Crop Photo
            </button>
        @endif
    </div>
    <div wire:ignore.self class="cropper-modal" x-data="{ show: false }">
        <div class="modal" x-show="show" @click.away="show = false">
            <div class="modal-content" @click.stop>
                <cropper :src="photo" ref="cropper" :aspect-ratio="1" />
                <div class="btn-container mt-3">
                    <button wire:click="save" class="btn btn-primary">
                        Save
                    </button>
                    <button wire:click="cancel" class="btn btn-secondary" x-on:click="show = false">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
