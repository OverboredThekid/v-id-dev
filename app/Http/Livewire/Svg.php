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
    }


    public function render()
    {
        return view('livewire.svg')->layout('layouts.svg');
    }
}
