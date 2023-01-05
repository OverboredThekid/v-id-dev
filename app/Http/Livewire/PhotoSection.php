<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $image;
    public $croppedImage;

    public function mount()
    {
        // Initialize WebcamJS
        $this->emit('initWebcam');
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }

    public function capture()
    {
        // Capture image from webcam and emit it to the frontend
        $this->emit('capture');
    }

    public function openFilePicker()
    {
        // Open file picker to select image from computer
        $this->emit('openFilePicker');
    }

    public function upload()
    {
        // Validate uploaded file
        $this->validate([
            'image' => 'required|image|max:1024'
        ]);

        // Emit uploaded image to the frontend
        $this->image = $this->image->temporaryUrl();
        $this->emit('upload');
    }

    public function crop($image)
    {
        // Set cropped image and emit it to the frontend
        $this->croppedImage = $image;
        $this->emit('crop', $image);
    }

    public function save()
    {
        // Save the cropped image to the server
        // You can implement your own code here to save the image to the server
        // You may also want to delete the original image or the captured image if you don't need them anymore
        $this->emit('save');
    }
}
