<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Beier\FilamentPages\Models\FilamentPage;

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
        return view('livewire.link-tree')->layout('layouts.linkTree');
    }
}
