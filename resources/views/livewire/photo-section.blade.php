<div>
    @if ($photo)
    <img src="{{ $photo }}" alt="Photo" class="w-full">
    @endif

    <div class="mt-4">
        <label class="inline-flex items-center">
            <input type="radio" class="form-radio" wire:model="photoType" value="capture" wire:click="$set('photo', null)">
            <span class="ml-2">Capture Photo</span>
        </label>
        <label class="inline-flex items-center ml-6">
            <input type="radio" class="form-radio" wire:model="photoType" value="upload" wire:click="$set('photo', null)">
            <span class="ml-2">Upload Photo</span>
        </label>
    </div>

    @if ($photoType == 'capture')
    <div class="mt-4">
        <video wire:ignore wire:ref="video" class="w-full"></video>
        <button wire:click="capturePhoto" class="btn btn-primary mt-4">Capture</button>
    </div>
    @elseif ($photoType == 'upload')
    <div class="mt-4">
        <input type="file" wire:model="photo" class="form-input">
        <button wire:click="uploadPhoto" class="btn btn-primary mt-4">Upload</button>
    </div>
    @endif
    @if ($photo)
    <img src="{{ $photo }}" alt="Photo" class="w-full">
    @endif

    @if ($photo)
    <div class="mt-4">
        <button wire:click="cropPhoto" class="btn btn-primary">Crop</button>
        <button wire:click="submit" class="btn btn-secondary">Submit</button>
    </div>
    @endif

    @if ($croppedPhoto)
    <div class="mt-4">
        <img src="{{ $croppedPhoto }}" alt="Cropped Photo" class="w-full">
    </div>
    @endif
    <script>
        function getUserMedia(constraints) {
            if (navigator.mediaDevices.getUserMedia) {
                return navigator.mediaDevices.getUserMedia(constraints);
            } else if (navigator.mediaDevices.webkitGetUserMedia) {
                return navigator.mediaDevices.webkitGetUserMedia(constraints);
            } else if (navigator.mediaDevices.mozGetUserMedia) {
                return navigator.mediaDevices.mozGetUserMedia(constraints);
            } else {
                return Promise.reject(new Error('Your browser does not support getUserMedia'));
            }
        }

        function startVideo() {
            const video = document.querySelector('[wire\\:ref=video]');
            const constraints = {
                video: true
            };

            getUserMedia(constraints)
                .then((stream) => {
                    video.srcObject = stream;
                    video.addEventListener('loadedmetadata', () => {
                        video.play();
                    });
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        function stopVideo(videoElement) {
            const stream = videoElement.srcObject;
            const tracks = stream.getTracks();

            tracks.forEach((track) => {
                track.stop();
            });

            videoElement.srcObject = null;
        }

        function captureFrame(videoElement) {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;

            context.drawImage(videoElement, 0, 0);

            // return data URL representing the captured photo
            return canvas.toDataURL('image/jpeg');
        }


        window.addEventListener('DOMContentLoaded', () => {
            const video = document.querySelector('[wire\\:ref=video]');

            startVideo();

            document.querySelector('[wire\\:click=capturePhoto]').addEventListener('click', () => {
                Livewire.emit('capturePhoto', captureFrame(video));
                stopVideo(video);
                startVideo();
            });
        });
    </script>
</div>