<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;


class PhotoSection extends Component
{
    use WithFileUploads;

    public $showCaptureForm = false;
    public $showUploadForm = false;
    public $photo;
    public $croppedPhotoUrl;
    public $showCropModal = false;

    public function showCaptureForm()
    {
        $this->resetForm();
        $this->showCaptureForm = true;
    }

    public function showUploadForm()
    {
        $this->resetForm();
        $this->showUploadForm = true;
    }

    public function resetForm()
    {
        $this->showCaptureForm = false;
        $this->showUploadForm = false;
        $this->photo = null;
        $this->croppedPhotoUrl = null;
        $this->showCropModal = false;
    }

    public function photoCaptured($dataUri)
    {
        $this->photo = Image::make($dataUri);
        $this->openCropModal();
    }

    public function openCropModal()
    {
        $this->showCropModal = true;
    }

    public function closeCropModal()
    {
        $this->resetForm();
    }

    public function cropPhoto()
    {
        $this->croppedPhotoUrl = $this->photo
            ->fit(300, 300)
            ->encode('data-url');
    }

    public function submitPhoto()
    {
        // Save the photo to your storage or database here...

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
