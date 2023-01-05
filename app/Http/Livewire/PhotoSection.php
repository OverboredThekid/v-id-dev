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
    public $showCropModal = false;
    public $croppedPhotoUrl;

    public function showCaptureForm()
    {
        $this->showCaptureForm = true;
        $this->showUploadForm = false;
        $this->photo = null;
        $this->showCropModal = false;
    }

    public function showUploadForm()
    {
        $this->showCaptureForm = false;
        $this->showUploadForm = true;
        $this->photo = null;
        $this->showCropModal = false;
    }

    public function photoCaptured($dataUri)
    {
        $this->photo = $dataUri;
        $this->openCropModal();
    }

    public function openCropModal()
    {
        $this->showCropModal = true;
    }

    public function closeCropModal()
    {
        $this->showCropModal = false;
    }

    public function submitPhoto()
    {
        $this->validate([
            'photo' => 'required|image|max:1024',
        ]);

        $croppedPhoto = Image::make($this->photo)
            ->fit(400, 400)
            ->encode('jpg');

        $this->croppedPhotoUrl = $croppedPhoto->encoded;
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
