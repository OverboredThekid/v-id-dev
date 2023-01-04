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

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }

    public function cropPhoto($formData)
    {
        $croppedPhoto = Image::make($formData['cropped_photo']);
        $this->croppedPhoto = $croppedPhoto->encode('data-url');
    }

    public function submitPhoto()
    {
        // Handle submission of final photo here...
    }
}
