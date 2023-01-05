<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoSection extends Component
{
    use WithFileUploads;

 
    public $showCaptureModal = false; // Define the property
    public $showUploadModal = false;
    public $showCropper = false;
    public $capture;
    public $upload;
    public $croppedImage;

    public function openCaptureModal()
    {
        $this->showCaptureModal = true; // Set the property to true
    }

    public function openUploadModal()
    {
        $this->showUploadModal = true;
    }

    public function captureImage()
    {
        $this->capture->store('captures');
        $this->croppedImage = $this->capture->getRealPath();
        $this->showCropper = true;
    }

    public function uploadImage()
    {
        $this->validate([
            'upload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->croppedImage = $this->upload->getRealPath();
        $this->showCropper = true;
    }

    public function resetForm()
    {
        $this->showCaptureModal = false;
        $this->showUploadModal = false;
        $this->showCropper = false;
        $this->capture = null;
        $this->upload = null;
        $this->croppedImage = null;
    }

    public function submitForm()
    {
        $this->validate([
            'croppedImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Save the cropped image to storage or database, etc.

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
