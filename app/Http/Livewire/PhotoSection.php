<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $croppedPhoto;

    public function openCamera()
    {
        $this->croppedPhoto = null;
        $this->photo = null;

        echo '
            <script>
                window.Webcam.set({
                    width: 400,
                    height: 300,
                    image_format: "jpeg",
                    jpeg_quality: 90
                });
                window.Webcam.attach("#camera");
            </script>
            <div id="camera"></div>
            <button wire:click="capture" class="btn btn-primary">Capture</button>
        ';
    }

    public function capture()
    {
        $photoData = request()->input('webcam');
        list($type, $photoData) = explode(';', $photoData);
        list(, $photoData) = explode(',', $photoData);
        $photoData = base64_decode($photoData);

        $fileName = 'captured-photo-' . time() . '.jpg';
        Storage::disk('public')->put($fileName, $photoData);

        $this->photo = '/storage/' . $fileName;

        echo '
            <script>
                window.Webcam.reset();
            </script>
        ';
    }

    public function crop()
    {
        $this->croppedPhoto = null;

        echo '
            <script>
                window.livewire.emit("cropperModalOpened")
            </script>
        ';
    }

    public function save()
    {
        $croppedImage = Image::make($this->photo)
            ->fit(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

        $fileName = 'cropped-photo-' . time() . '.jpg';
        Storage::disk('public')->put($fileName, (string) $croppedImage->encode());

        $this->croppedPhoto = '/storage/' . $fileName;

        echo '
            <script>
                window.livewire.emit("cropperModalClosed")
            </script>
        ';
    }

    public function cancel()
    {
        echo '
            <script>
                window.livewire.emit("cropperModalClosed")
            </script>
        ';
    }

    public function resetpage()
    {
        $this->croppedPhoto = null;
        $this->photo = null;
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
