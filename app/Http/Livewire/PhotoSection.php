<?php

namespace App\Http\Livewire;

use Livewire\Component;


class PhotoSection extends Component
{
    public $photo;
    public $showWebcam = false;
    
    public function openFileInput()
    {
        $this->photo = null;
        $this->emit('openFileInput');
    }

    public function upload($event)
    {
        $this->photo = $event->target->files[0];
        $this->emit('photoSelected');
    }

    public function capture()
    {
        $video = $this->get('video');
        $image = $this->get('image');
        $canvas = $this->get('canvas');

        $image->src = $canvas->toDataURL('image/png');
        $canvas->getContext('2d')->drawImage($video, 0, 0, $canvas->width, $canvas->height);
        $this->photo = $image->src;
        $this->emit('photoSelected');
    }

    public function crop()
    {
        $cropper = $this->get('cropper');
        $image = $this->get('image');

        $croppedData = $cropper->cropper('getData');

        $canvas = $this->get('canvas');
        $canvas->getContext('2d')->drawImage($image, $croppedData['x'], $croppedData['y'], $croppedData['width'], $croppedData['height'], 0, 0, $canvas->width, $canvas->height);

        $this->photo = $canvas->toDataURL('image/png');
        $this->emit('photoCropped');
    }

    public function render()
    {
        return view('livewire.photo-section');
    }
}
