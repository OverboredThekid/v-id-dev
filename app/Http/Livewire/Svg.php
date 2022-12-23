<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff_prints;
use Illuminate\Support\Str;


class Svg extends Component
{
    public $staff, $staff_img, $staff_last, $staff_first;
 
    public function mount($id)
    {
        $staff_info = staff_prints::findOrFail($id);
        $this->staff = $staff_info;
        $this->staff_img = $staff_info->getFirstMedia('staff_print')->getUrl();
        $last = Str::after($staff_info->name, ' ');
        $first = Str::before($staff_info->name, ' ');
        $this->staff_last = $last;
        $this->staff_first = $first;

    }


    public function render()
    {
        return view('livewire.svg')->layout('layouts.svg');
    }
}
