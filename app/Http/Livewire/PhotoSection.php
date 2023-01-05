<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PhotoSection extends Component
{
        use WithFileUploads;
    
        public $photo;
        public $croppedPhoto;
    
        public function render()
        {
            return view('livewire.photo-section');
        }
    
        public function capturePhoto()
        {
            $this->photo = null;
            $this->croppedPhoto = null;
            $this->emit('photoCaptured');
        }
    
        public function uploadPhoto(UploadedFile $photo)
        {
            $this->photo = $photo;
            $this->croppedPhoto = null;
            $this->emit('photoUploaded');
        }
    
        public function cropPhoto($photoData)
        {
            $tempPhoto = tempnam(sys_get_temp_dir(), 'upload');
            file_put_contents($tempPhoto, base64_decode($photoData));
    
            $image = Image::make($tempPhoto);
            $croppedImage = $image->crop((int) $photoData['width'], (int) $photoData['height'], (int) $photoData['x'], (int) $photoData['y']);
    
            $tempFile = tempnam(sys_get_temp_dir(), 'upload');
            $croppedImage->save($tempFile);
    
            $this->croppedPhoto = $tempFile;
            unlink($tempPhoto);
    
            $this->emit('photoCropped');
        }
    
        public function savePhoto()
        {
            if ($this->croppedPhoto) {
                $photo = $this->croppedPhoto;
            } else {
                $photo = $this->photo;
            }
    
            $path = $this->store($photo);
    
            // Save $path to database or wherever you need to store it
    
            $this->reset();
        }      
    }