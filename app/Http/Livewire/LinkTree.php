<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff as DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LinkTree extends Component
{

    public $staff;

    public function mount($id)
    {
        // Will return a ModelNotFoundException if no user with that id
        try {
            $this->staff = DB::findorfail($id);
        }
        // catch(Exception $e) catch any exception
        catch (ModelNotFoundException $e) {
            dd(get_class_methods($e)); // lists all available methods for exception object
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.link-tree');
    }
}
