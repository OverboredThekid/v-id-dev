<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Beier\FilamentPages\Models\FilamentPage as DB;

class FrontEnd extends Component
{

    public $page;

    public function mount($slug)
    {
        $this->page = DB::findorfail($slug);
    }

    public function render()
    {
        return view('livewire.front-end')->layout('layouts.FrontEnd');
    }
}
