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
        $page = FilamentPage::where('is_QrPage', '=', 1)->firstOrFail();
        $this->staff = $staff_info;
        $this->slug = $page;

    }

    public function render()
    {
        return view('livewire.linkTree')->layout('layouts.linkTree');
    }
}
