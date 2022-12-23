<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff_prints;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class Svg extends Component
{
    public $staff, $staff_img, $staff_last, $staff_first, $qrCode;
 
    public function mount($id)
    {
        Auth::check()?:abort(403);
        $staff_info = staff_prints::findOrFail($id);
        $this->staff = $staff_info;
        $this->staff_img = $staff_info->getFirstMedia('staff_print')->getUrl();
        $last = Str::after($staff_info->staff->name, ' ');
        $first = Str::before($staff_info->staff->name, ' ');
        $this->staff_last = $last;
        $this->staff_first = $first;
        $this->generateQrCode();
    }
    public function generateQrCode()
    {
        $this->qrCode = base64_encode(QrCode::size(250)->eyeColor(0, 255, 255, 255, 0, 0, 0)->style('square')->format('svg')->merge('assets/img/gav-small-white.png', .3)->generate("http://generationsav.com/stafflinks/"));
    }

    public function render()
    {
        return view('livewire.svg', [
            'qrCode' => $this->qrCode,
        ])->layout('layouts.svg');
    }
}
