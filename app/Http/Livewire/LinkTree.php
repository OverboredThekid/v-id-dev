<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff;

class LinkTree extends Component
{

    public $staff, $slug;
 
    public function mount($id)
    {
        $staff_info = staff::findOrFail($id);
        $this->staff = $staff_info;
    }

    public function render()
    {
        return view('livewire.linkTree')->layout('layouts.linkTree');
    }
}
