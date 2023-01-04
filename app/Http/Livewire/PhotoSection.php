<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PhotoSection extends Component
{
    public $capturing = false;
    public $uploading = false;
    public $cropping = false;
    public $submitting = false;
    public $croppedImage;
    
    public function capturePhoto()
    {
        $this->capturing = true;
    }
    
    public function submitPhoto()
    {
        if($this->capturing) {
            $video = document.getElementById('webcam');
            let canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            let data = canvas.toDataURL('image/png');
            this->emit('captureSuccess');
            this->cropping = true;
        } else if($this->uploading) {
            let file = document.getElementById('photoUpload').files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                this->croppedImage = reader.result;
                this->cropping = true;
            }
            reader.readAsDataURL(file);
        } else {
            this->submitting = true;
        }
    }
    
    public function uploadPhoto()
    {
        this->uploading = true;
    }
    
    public function cancelCapture()
    {
        this->capturing = false;
    }
    
    public function cancelUpload()
    {
        this->uploading = false;
    }
    
    public function cancelCrop()
    {
        this->cropping = false;
    }
    
    public function confirmSubmit()
    {
        // code to submit photo to server or store it locally
        this->submitting = false;
    }
    
    public function cancelSubmit()
    {
        this->submitting = false;
    }
    
    public function croppedImage($dataUrl)
    {
        this->croppedImage = $dataUrl;
    }
    
}
