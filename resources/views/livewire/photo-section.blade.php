<div>

    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
    </head>
    <style type="text/css">
        img {

            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        /* Add grayed out background to modal */
        .modal-backdrop {
            background-color: #000;
            height: 100% !important;
            width: 100% !important;
        }
    </style>
    <!--Using Tailwind CSS classes for responsive design-->
    <div>
        <div>
            <label class="btn btn-primary" style="margin-bottom: 10px;">
                <input type="file" name="image" class="image" accept="image/*" style="display: none;">Upload A Photo
            </label>
            <br>

            <div class="relative h-screen">
                <div class="embed-responsive embed-responsive-16by9 sm:w-50 h-auto">
                    <video id="webcam" width="100%" height="100%" autoplay class="embed-responsive-item" style="display: none;" playsinline></video>
                </div>


                <div id="loading-message" class="absolute inset-0 flex items-center justify-center text-gray-700" style="display: none;">
                    Loading webcam...
                </div>

                <div class="relative">
                    <button id="activate-webcam" class="bg-blue-500 text-white rounded-lg btn btn-primary">Take A Photo</button>

                    <div class="flex justify-between items-center mt-4">
                        <button id="take-photo" class="bg-blue-500 text-white rounded-lg btn btn-primary" style="display: none;">Capture</button>
                        <button id="turn-off-webcam" class="bg-blue-500 text-white rounded-lg btn btn-primary pt-10" style="display: none; margin-top: 10px;">Turn Off Webcam</button>
                    </div>

                </div>
            </div>


            <br>

            <div class="modal fade" style="margin-top:5%" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="margin: 0">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Crop Image To Size</h5>
                            <button type="button" class="close" style="background-color:#fff;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                    </div>

                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Get the video element
        var video = document.getElementById('webcam');

        // Get the "Activate Webcam" button
        var activateWebcamButton = document.getElementById('activate-webcam');

        // Get the loading message element
        var loadingMessage = document.getElementById('loading-message');

        // Add an event listener to the button
        activateWebcamButton.addEventListener('click', function() {
            // Show the loading message
            loadingMessage.style.display = 'block';
            // Get access to the user's webcam
            navigator.mediaDevices.getUserMedia({
                video: true
            }).then(function(stream) {
                video.srcObject = stream;
                video.style.display = 'block';
                activateWebcamButton.style.display = 'none';
                document.getElementById('take-photo').style.display = 'block';
                // Hide the loading message
                loadingMessage.style.display = 'none';
                document.getElementById('turn-off-webcam').style.display = 'block';
            });
        });

        // Get the "Take Photo" button
        var takePhotoButton = document.getElementById('take-photo');

        // Add an event listener to the button
        takePhotoButton.addEventListener('click', function() {
            // Get the canvas element
            var canvas = document.createElement('canvas');
            // Set the canvas to the same dimensions as the video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            // Get the canvas context
            var context = canvas.getContext('2d');
            // Draw the current frame of the video onto the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            // Get the image data from the canvas
            var imageData = canvas.toDataURL('image/png');
            // Set the src of the image element to the image data
            image.src = imageData;
            // Show the modal
            $modal.modal('show');
            // Show the "Turn Off Webcam" button
        });

        // Get the "Turn Off Webcam" button
        var turnOffWebcamButton = document.getElementById('turn-off-webcam');

        // Add an event listener to the button
        turnOffWebcamButton.addEventListener('click', function() {
            // Stop the video stream
            video.srcObject.getVideoTracks().forEach(function(track) {
                track.stop();
            });
            // Hide the video element and the "Turn Off Webcam" button
            video.style.display = 'none';
            takePhotoButton.style.display = 'none';
            activateWebcamButton.style.display = 'block';
            turnOffWebcamButton.style.display = 'none';
        });

        // DO NOT DELETE
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
            let webcamElement = document.querySelector("#webcam");
            webcamElement.pause();
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
            let webcamElement = document.querySelector("#webcam");
            webcamElement.play();
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 360,
                height: 360,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;

                    // Emit an event with the image data
                    window.livewire.emit('sendBase64Image', base64data);

                    // Close the modal
                    $modal.modal('hide');
                }
            });
        });
    </script>
</div>