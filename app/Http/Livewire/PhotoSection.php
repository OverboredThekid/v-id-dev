<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $photoUrl;
    public $croppedPhoto;
    public $croppedPhotoUrl;
    public $uploaded = false;
    public $cropped = false;

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }

    public function capture()
    {
        $this->photo = Image::make($this->photoUrl)->encode('jpg');
        $this->uploaded = true;
    }

    public function crop()
    {
        $this->croppedPhoto = Image::make($this->croppedPhotoUrl)->encode('jpg');
        $this->cropped = true;
    }

    public function submit()
    {
        $this->validate([
            'croppedPhoto' => 'required|image|max:1024',
        ]);

        // Save the cropped photo to your desired location
        // and do any other processing you need to do with it.
        $this->croppedPhoto->save(public_path('photos/cropped.jpg'));
    }
}
