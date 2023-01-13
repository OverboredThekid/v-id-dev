<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff_prints;
use app\Settings\BadgeSettings;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use DOMDocument;
use DOMXPath;

class Svg extends Component
{
    public $staff, $staff_img, $staff_last, $staff_first, $qrCode, $exp_date, $qr_logo, $svg_front, $svg_back;
    public function expdate(): string
    {
        return app(BadgeSettings::class)->exp_date;
    }
    public function svgfront(): string
    {
        return app(BadgeSettings::class)->svg_front;
    }
    public function svgback(): string
    {
        return app(BadgeSettings::class)->svg_back;
    }
    public function qrlogo(): string
    {
        return app(BadgeSettings::class)->qr_logo;
    }
    public function mount($id)
    {
        Auth::check() ?: abort(403);
        $staff_info = staff_prints::findOrFail($id);
        $this->staff = $staff_info;
        $this->staff_img = $staff_info->getFirstMedia('staff_print')->getUrl();
        $last = Str::after($staff_info->staff->name, ' ');
        $first = Str::before($staff_info->staff->name, ' ');
        $this->staff_last = $last;
        $this->staff_first = $first;
        $this->qr_logo = $this->qrlogo();
        $qrCode = base64_encode(QrCode::size(250)->eyeColor(0, 237, 28, 36, 0, 0, 0)->eyeColor(1, 237, 28, 36, 0, 0, 0)->eyeColor(2, 237, 28, 36, 0, 0, 0)->eye('circle')->style('square')->format('svg')->generate("Https://$_SERVER[HTTP_HOST]/staff/" . $staff_info->staff->id));
        $this->qrCode = $qrCode;
        $staff_info = $staff_info->update(['is_active' => 1]);
        $this->exp_date = $this->expdate();


        //Front Of Card
        $svg_front = file_get_contents(url('/storage/'.$this->svgfront()));
        $dom_front = new DOMDocument();
        $dom_front->loadXML($svg_front);
        $xpath_front = new DOMXPath($dom_front);



        $elements_front = $xpath_front->query("//*[@id='targetId']");
        foreach ($elements_front as $element_front) {
            // Create a new div element
            $new_front = $dom_front->createElement("div");
            $new_front->setAttribute("id", "newId");
            $new_front->nodeValue = "new content";
            // Replace the existing div element with the new one
            $element_front->parentNode->replaceChild($new_front, $element_front);
        }

        $svg_front = $dom_front->saveXML();
        $this->svg_front = $svg_front;

    //Back Of Card
    $svg_back = file_get_contents(url('/storage/'.$this->svgback()));
    $dom_back = new DOMDocument();
    $dom_back->loadXML($svg_back);
    $xpath_back = new DOMXPath($dom_back);
    $elements_back = $xpath_back->query("//*[@id='qr_code']");
    foreach ($elements_back as $element_back) {
        // Create a new div element
        $new_back = $dom_back->createElement("div");
        //copy all the attributes of the original element
        foreach ($element_back->attributes as $attribute) {
            if($attribute->nodeName != "xlink:href"){
                $new_back->setAttribute($attribute->nodeName, $attribute->nodeValue);
            }
        }
        $new_back->setAttribute("xlink:href", "data:image/svg+xml;base64,". $qrCode);
        // Replace the existing div element with the new one
        $element_back->parentNode->replaceChild($new_back, $element_back);
    }
    $svg_back = $dom_back->saveXML();
    $this->svg_back = $svg_back;


    }

    public function render()
    {
        return view('livewire.svg', [
            'qrCode' => $this->qrCode,
        ])->layout('layouts.svg');
    }
}
