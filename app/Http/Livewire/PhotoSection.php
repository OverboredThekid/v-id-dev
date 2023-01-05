<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $cropping;

    public function mount()
    {
        $this->cropping = false;
    }

    public function capture()
    {
        $this->photo = null;
        $this->cropping = false;

        $this->call('capture');
    }

    public function save()
    {
        $this->validate([
            'photo' => 'required|image|max:1024'
        ]);

        $this->photo = Image::make($this->photo)
            ->fit(320, 320, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode('jpg', 75);

        $this->cropping = false;
    }

    public function crop()
    {
        $this->cropping = true;
    }

    public function cropped($data)
    {
        $this->photo = Image::make($this->photo)
            ->crop((int) $data['height'], (int) $data['width'], (int) $data['x'], (int) $data['y'])
            ->encode('jpg', 75);
    }

    public function remove()
    {
        $this->photo = null;
        $this->cropping = false;
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
