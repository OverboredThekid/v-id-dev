<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PhotoSection extends Component
{
    public $photo;

    public function submit()
    {
        $this->validate([
            'photo' => ['required', 'image', 'max:1024'],
        ]);

        // Process the submitted photo data (e.g. store on server, update user record)

        session()->flash('message', 'Photo saved successfully.');
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
