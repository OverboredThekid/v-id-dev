<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff_prints;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class Svg extends Component
{
    public function render()
    {
        return view('livewire.Home')->layout('layouts.Home');
    }
}
