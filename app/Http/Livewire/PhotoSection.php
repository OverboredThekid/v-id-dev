<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $croppedPhoto;
    public $showWebcam = false;
    public $showFileInput = false;
    public $showCropper = false;

    public function openWebcam()
    {
        $this->resetpage();
        $this->showWebcam = true;
    }

    public function openFileInput()
    {
        $this->resetpage();
        $this->showFileInput = true;
    }

    public function openCropper()
    {
        $this->showCropper = true;
    }

    public function cancelWebcam()
    {
        $this->resetpage();
    }

    public function cancelFileInput()
    {
        $this->resetpage();
    }

    public function cancelCropper()
    {
        $this->showCropper = false;
    }

    public function submit()
    {
        if ($this->croppedPhoto) {
            $this->photo = $this->croppedPhoto;
        }

        $this->resetpage();
        $this->emit('photoSelected', $this->photo);
    }

    public function resetpage()
    {
        $this->photo = null;
        $this->croppedPhoto = null;
        $this->showWebcam = false;
        $this->showFileInput = false;
        $this->showCropper = false;
    }
}
