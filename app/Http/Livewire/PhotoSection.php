<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $croppedPhoto;
    public $photoType;


    public function mount()
{
    $this->photo = null;
    $this->croppedPhoto = null;
    $this->photoType = 'capture'; // initialize $photoType
}


    public function render()
    {
        return view('livewire.photo-section');
    }

    public function capturePhoto($photo)
    {
        $this->photo = $photo;
        $this->croppedPhoto = null;
    }

    public function uploadPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024'
        ]);

        $this->photo = $this->photo->store('photos');
        $this->croppedPhoto = null;
    }

    public function cropPhoto()
    {
        $this->validate([
            'croppedPhoto' => 'required|image|max:1024'
        ]);

        $image = Image::make($this->croppedPhoto);
        $this->photo = $image->encode('jpg', 75)->fit(300, 300)->store('photos');
        $this->croppedPhoto = null;
    }

    public function submit()
    {
        $this->validate([
            'photo' => 'required|image|max:1024'
        ]);

        // Here you can do something with the final photo, such as storing it to a database or displaying it on the page
    }
}
