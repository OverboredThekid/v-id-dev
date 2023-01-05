<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoSection extends Component
{
    use WithFileUploads;

    public $photo;

    public function submit()
    {
        // Validate and store the uploaded photo...
    }

    public function render()
    {
        return view('livewire.photo-section');
    }
}
