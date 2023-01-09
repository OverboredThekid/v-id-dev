<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;


class PhotoSection extends Component
{
    use WithFileUploads;



    public function upload()
    {
        return response()->json(['success'=>'success']);
    }

    public function render()
    {
        return view('livewire.photo-section')->layout('layouts.photo');
    }
}
