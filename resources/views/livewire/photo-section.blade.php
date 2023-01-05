<div>
    <div class="w-full flex justify-center mt-4">
        @if ($photo)
            <img id="photo" src="{{ $photo }}" class="w-1/2 h-64 object-cover object-center rounded-lg shadow-lg">
        @endif
    </div>

    <div class="w-full flex justify-center mt-4">
        @if (! $photo)
            <button wire:click="capture" class="btn btn-primary mr-2">
                Capture Photo
            </button>
            <input type="file" wire:model="photo" class="hidden">
            <button wire:click="$emit('fileChooseClicked')" class="btn btn-primary ml-2">
                Choose from Computer
            </button>
        @endif
    </div>

    @if ($photo)
        <div class="w-full flex justify-center mt-4">
            <button wire:click="submit" class="btn btn-primary">
                Crop and Submit
            </button>
        </div>
    @endif
</div>

@push('scripts')
    @if ($photo)
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                var image = document.getElementById('photo');
                var cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                });

                @this.set('cropper', cropper)
            });
        </script>
    @endif

    <script>
        window.livewire.on('fileChooseClicked', function () {
            document.querySelector('input[type=file]').click();
        });
    </script>
@endpush
