<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;


class PhotoSection extends Component
{
    use WithFileUploads;

    public $capturedImage;
    public $uploadedImage;
    public $croppedImage;

    public function capture()
    {
        $this->capturedImage = Image::make($_POST['image'])->encode('jpg');
        $this->emit('showModal');
    }

    public function upload()
    {
        $this->uploadedImage = Image::make($this->image)->encode('jpg');
        $this->emit('showModal');
    }

    public function crop()
    {
        $this->croppedImage = Image::make($_POST['image'])
            ->crop((int) $_POST['x'], (int) $_POST['y'], (int) $_POST['width'], (int) $_POST['height'])
            ->encode('jpg');
    }
    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
