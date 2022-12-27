<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Beier\FilamentPages\Models\FilamentPage as DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FrontEnd extends Component
{

    public $page;

    public function mount($slug)
    {
        // Will return a ModelNotFoundException if no user with that id
        try {
            $this->page = DB::findorfail($slug);
        }
        // catch(Exception $e) catch any exception
        catch (ModelNotFoundException $e) {
            dd(get_class_methods($e)); // lists all available methods for exception object
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.front-end')->layout('layouts.FrontEnd');
    }
}
