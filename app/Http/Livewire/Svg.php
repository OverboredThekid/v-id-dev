<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff_prints;


class Svg extends Component
{
    public $staff, $staff_img;
 
    public function mount($id)
    {
        $media = staff_prints::findOrFail($id);
        $this->staff = $media;
        $this->staff_img = $media->getMedia('staff_img');
    }


    public function render()
    {
        return view('livewire.svg')->layout('layouts.svg');
    }
}
