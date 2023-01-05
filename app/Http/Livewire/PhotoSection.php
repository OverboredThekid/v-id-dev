<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class PhotoSection extends Component
{
    use WithFileUploads;

    // state variables
    public $photo;
    public $croppedPhoto;
    public $webcamOn;
    public $fileOn;

    // initialize state variables
    public function mount()
    {
        $this->webcamOn = false;
        $this->fileOn = false;
    }

    // toggle webcam on and off
    public function toggleWebcam()
    {
        $this->webcamOn = !$this->webcamOn;

        if ($this->webcamOn) {
            Webcam.attach('#my_camera');
        } else {
            Webcam.reset();
        }
    }

    // capture photo from webcam
    public function capture()
    {
        Webcam.snap(function(data_uri) {
            this.photo = data_uri;
            this.webcamOn = false;
            this.fileOn = true;
        });
    }

    // toggle file input on and off
    public function toggleFile()
    {
        this.fileOn = !this.fileOn;
    }

    // select photo from file input
    public function updatedPhoto($photo)
    {
        this.photo = $photo;
        this.fileOn = true;
    }

    // crop photo
    public function crop()
    {
        // create cropper
        $cropper = new Cropper(this.refs.photo, [
            'aspectRatio' => 1,
            'crop' => function($event) {
                $this->croppedPhoto = $event['detail']['canvas']->toDataURL();
            }.bind(this)
        ]);
    
        // crop photo
        $cropper->crop();
    }

    // submit photo
    public function submit()
    {
        this.$emit('photoSelected', this.croppedPhoto);
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
