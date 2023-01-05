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

    public function showCaptureModal()
    {
        $this->emit('showModal', 'captureModal');
    }

    public function showUploadModal()
    {
        $this->emit('showModal', 'uploadModal');
    }

    public function takePhoto()
    {
        $this->emit('hideModal', 'captureModal');

        $this->croppedPhoto = Image::make($_POST['croppedImage'])
            ->encode('jpg', 75);
    }

    public function cancelCrop()
    {
        $this->emit('showModal', 'captureModal');
    }

    public function submit()
    {
        $this->validate([
            'croppedPhoto' => ['required'],
        ]);

        // Save the cropped photo to your server or do whatever you need to with it...

        $this->emit('hideModal', 'captureModal');
        $this->emit('hideModal', 'uploadModal');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
