<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff_prints;


class Svg extends Component
{
    public $staff;
 
    public function mount($id)
    {
        $staff_info = staff_prints::findOrFail($id);
        $this->staff = $staff_info;
        $this->staff_img = $staff_info->getFirstMedia('staff_print')->getUrl();
    }


    public function render()
    {
        return view('livewire.svg')->layout('layouts.svg');
    }
}
