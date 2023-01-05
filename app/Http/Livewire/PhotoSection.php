<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;


class PhotoSection extends Component
{
    use WithFileUploads;


    // State variables
    public $captureModal = false;
    public $uploadModal = false;
    public $cropModal = false;
    public $photo;
    public $croppedPhoto;

    public function openCaptureModal()
    {
        // Initialize the webcam
        $this->initializeWebcam();

        $this->captureModal = true;
    }

    public function openUploadModal()
    {
        $this->uploadModal = true;
    }

    public function closeModal()
    {
        $this->captureModal = false;
        $this->uploadModal = false;
        $this->cropModal = false;
        $this->photo = null;
        $this->croppedPhoto = null;
    }

    public function capturePhoto()
    {
        // Get the photo from the webcam
        $this->photo = $this->getWebcamPhoto();

        // Close the capture modal and open the crop modal
        $this->captureModal = false;
        $this->cropModal = true;
    }

    public function uploadPhoto()
    {
        // Validate the uploaded photo
        $this->validate([
            'photo' => 'image|max:1024'
        ]);

        // Open the crop modal
        $this->uploadModal = false;
        $this->cropModal = true;
    }

    public function submitPhoto()
    {
        // Crop the photo
        $this->croppedPhoto = $this->cropPhoto();

        // Perform any additional actions, such as saving the photo to a database or storage service
        // ...

        // Close the crop modal and reset the form
        $this->cropModal = false;
        $this->photo = null;
        $this->croppedPhoto = null;
    }

    private function initializeWebcam()
    {
        // Set up the webcam using webcam.js
        $this->script('
            Webcam.set({
                width: 320,
                height: 240,
                image_format: "jpeg",
                jpeg_quality: 90
            });
            Webcam.attach("#webcam");
        ');
    }

    private function getWebcamPhoto()
    {
        // Capture the photo from the webcam using webcam.js
        $data = 'data:image/jpeg;base64,' . Webcam.snap();

        // Save the photo to a temporary file
        $file = $this->saveBase64Image($data);

        // Return the Intervention Image instance
        return Image::make($file);
    }

    private function saveBase64Image($data)
    {
        // Generate a random filename
        $filename = str_random(16) . '.jpg';

        // Save the data to a temporary file
        \File::put(storage_path('app/public/' . $filename), base64_decode(explode(',', $data)[1]));

        return storage_path('app/public/' . $filename);
    }

    private function cropPhoto()
    {
        // Initialize the cropper
        $this->script('
            var image = document.getElementById("photo");
            var cropper = new Cropper(image, {
                aspectRatio: 1,
                crop: function(e) {
                    $("input[name=x]").val(e.detail.x);
                    $("input[name=y]").val(e.detail.y);
                    $("input[name=height]").val(e.detail.height);
                    $("input[name=width]").val(e.detail.width);
                }
            });
        ');

        // Get the crop data from the form
        $data = [            'x' => request()->input('x'),            'y' => request()->input('y'),            'height' => request()->input('height'),            'width' => request()->input('width'),        ];

        // Crop the photo using Intervention Image
        return Image::make($this->photo)->crop(
            intval($data['height']),
            intval($data['width']),
            intval($data['x']),
            intval($data['y'])
        );
    }


    public function render()
    {
        return view('livewire.photo-section', [
            'photo' => $this->photo,
            'croppedPhoto' => $this->croppedPhoto
        ])->layout('layouts.photo');
    }
}
