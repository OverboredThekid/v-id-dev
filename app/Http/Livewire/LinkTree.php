<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff as DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Beier\FilamentPages\Models\FilamentPage;

class LinkTree extends Component
{
    public function render()
    {
        return view('livewire.link-tree')->layout('layouts.linkTree');
    }
}
