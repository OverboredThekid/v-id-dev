<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoSection extends Component
{
    use WithFileUploads;

 
    public $captureModalOpen = false;
    public $uploadModalOpen = false;
    public $cropModalOpen = false;

    public $capturedImage;
    public $uploadedPhoto;
    public $croppedImage;

    public function showCaptureModal()
    {
        $this->captureModalOpen = true;
    }

    public function hideCaptureModal()
    {
        $this->reset();
    }

    public function showUploadModal()
    {
        $this->uploadModalOpen = true;
    }

    public function hideUploadModal()
    {
        $this->reset();
    }

    public function showCropModal()
    {
        $this->cropModalOpen = true;
    }

    public function hideCropModal()
    {
        $this->reset();
    }

    public function takePhoto()
    {
        Webcam.snap(function(data_uri) {
            this.capturedImage = data_uri;
            this.showCropModal();
        }.bind(this));
    }

    public function uploadPhoto()
    {
        $this->validate([
            'uploadedPhoto' => 'required|image',
        ]);

        $this->croppedImage = $this->uploadedPhoto->getRealPath();
        $this->showCropModal();
    }

    public function cropAndSubmit()
    {
        $image = (new \Intervention\Image\ImageManager)->make($this->croppedImage);

        // You can perform cropping and other image manipulation here using the Intervention Image library.
        // Then, save the image and clear the form.
        $image->save(storage_path('app/public/cropped_image.jpg'));

        // Reset form and close modal
        $this->reset();
    }

    public function reset()
    {
        $this->captureModalOpen = false;
        $this->uploadModalOpen = false;
        $this->cropModalOpen = false;

        $this->capturedImage = null;
        $this->uploadedPhoto = null;
        $this->croppedImage = null;

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
