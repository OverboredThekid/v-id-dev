<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $cropper;

    public function capture()
    {
        $this->validate([
            'photo' => 'required|image',
        ]);

        $this->photo = $this->photo->getRealPath();

        $this->emit('photoCaptured');
    }

    public function submit()
    {
        $croppedImage = Image::make($this->cropper->getCroppedCanvas()->toDataURL())->encode('jpg');

        $this->emit('photoSubmitted', $croppedImage);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
