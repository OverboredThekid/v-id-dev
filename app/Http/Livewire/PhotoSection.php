<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $croppedPhoto;

    public function cropPhoto()
    {
        // Get cropper.js instance
        $cropper = get('#cropper-image').data('cropper');

        // Get cropped image data
        $imageData = $cropper . getData();
        $imageDataWidth = $imageData['width'];
        $imageDataHeight = $imageData['height'];
        $imageDataX = $imageData['x'];
        $imageDataY = $imageData['y'];

        // Create canvas to store cropped image
        $canvas = document . createElement('canvas');
        $canvas . width = $imageDataWidth;
        $canvas . height = $imageDataHeight;
        $context = $canvas . getContext('2d');

        // Draw cropped image on canvas
        $context . drawImage(
            document . getElementById('cropper-image'),
            $imageDataX,
            $imageDataY,
            $imageDataWidth,
            $imageDataHeight,
            0,
            0,
            $imageDataWidth,
            $imageDataHeight
        );

        // Convert canvas to data URL
        $this->croppedPhoto = $canvas . toDataURL();
    }

    public function submitPhoto()
    {
        // If photo was taken with webcam
        if ($this->croppedPhoto) {
            // Convert data URL to binary image data
            $image = Image::make($this->croppedPhoto);
            $image = (string) $image->encode('jpg');
            $this->photo = "data:image/jpg;base64," . base64_encode($image);
        }

        // Validate and store uploaded photo
        $this->validate([
            'photo' => 'image|max:1024', // max size in kilobytes
        ]);
        $this->storePhoto();
    }

    public function storePhoto()
    {
        // Store photo in desired location (e.g. public/photos)
        $path = $this->photo->store('photos');

        // Do something with the stored photo (e.g. update user profile)
        // ...
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
