<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;
    public $cropped_image;

    public function capturePhoto()
    {
        // The photo data is saved to a hidden input in the blade view script
        // We can retrieve it here and store it in the $photo property
        $this->photo = $this->cropped_image;
    }

    public function cropPhoto()
    {
        // The cropped image data is saved to a hidden input in the blade view script
        // We can retrieve it here and store it in the $photo property
        $this->photo = $this->cropped_image;

        // Close the modal
        $this->emit('closeModal');
    }

    public function submit()
    {
        // Do something with the $photo here, such as saving it to the database
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
