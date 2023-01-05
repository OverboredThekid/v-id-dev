<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;


class PhotoSection extends Component
{
    use WithFileUploads;


    // State variables
    public $photo;

    public function capture()
    {
        $this->photo = Image::canvas(400, 400)->encode('data-url');

        $this->emit('photoCaptured');
    }

    public function upload()
    {
        $this->validate([
            'photo' => 'image|max:1024'
        ]);

        $this->photo = Image::make($this->photo)->encode('data-url');

        $this->emit('photoUploaded');
    }

    public function crop()
    {
        $cropped = Image::make($this->photo)
            ->crop(
                request()->input('cropper.height'),
                request()->input('cropper.width'),
                request()->input('cropper.x'),
                request()->input('cropper.y')
            )
            ->encode('data-url');

        $this->photo = $cropped;

        $this->emit('photoCropped');
    }

    public function closeModal()
    {
        $this->reset();

        $this->emit('modalClosed');
    }
    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
