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
    public $cropping;

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }

    public function capture()
    {
        $this->validate([
            'photo' => 'required|image|max:1024',
        ]);

        $this->cropping = true;
    }

    public function crop()
    {
        $croppedPhoto = (new \Crop($this->photo))
            ->setCoordinates($this->x, $this->y, $this->width, $this->height)
            ->getCroppedImage();

        $this->croppedPhoto = $croppedPhoto->encode('jpg');
        $this->cropping = false;
    }

    public function submit()
    {
        $this->validate([
            'croppedPhoto' => 'required|image|max:1024',
        ]);

        // Persist the photo to your database or storage.

        // Reset the component state.
        $this->resetpage();
    }

    public function resetpage()
    {
        $this->photo = null;
        $this->croppedPhoto = null;
        $this->cropping = false;
    }
}
