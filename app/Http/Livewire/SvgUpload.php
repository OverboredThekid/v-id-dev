<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SvgUpload extends Component
{
    public function render()
    {
        return view('livewire.svg-upload')->layout('layouts.svg-upload');
    }

}
