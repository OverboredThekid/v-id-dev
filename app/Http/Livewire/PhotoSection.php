<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;
use CropperJS;
use WebcamJS;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $croppedPhoto;

    public function capture()
    {
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#webcam');
    }

    public function upload()
    {
        Webcam.reset();
        this.photo = this.refs.fileInput.files[0];
    }

    public function crop()
    {
        CropperJS.crop();
        this.croppedPhoto = CropperJS.getCroppedCanvas().toDataURL();
        CropperJS.destroy();
    }

    public function save()
    {
        // Save the cropped photo to your server or database here.
    }

    public function render()
    {
        return view('livewire.photo-section');
    }
}
