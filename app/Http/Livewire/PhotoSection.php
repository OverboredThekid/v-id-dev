<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;


class PhotoSection extends Component
{
    use WithFileUploads;


    public $image;

    public function mount()
    {
        $this->image = null;
    }

    public function sendBase64Image($imageData)
    {
        // Process the image data as needed, for example,
        // save it to the server or store it in the database
        $this->image = $imageData;

        // Emit an event with the image data
        $this->emit('imageProcessed', $this->image);
    }
    
    public function upload()
    {
        return response()->json(['success'=>'success']);
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
