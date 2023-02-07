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
use Carbon\Carbon;
use Tidy;


class Svg extends Component
{
    public $staff, $staff_img, $staff_last, $staff_first, $qrCode, $exp_date, $qr_logo, $svg_front, $svg_back, $month, $position;
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
    public function mount($id) {
        $this->checkAuthorization();
        $this->getStaffInfo($id);
        $this->getStaffImage();
        $this->splitName();
        $this->position();
        $this->generateQrCode();
        $this->updateStaffStatus();
        $this->generateExpDate();
        $this->generateFrontCard();
        $this->generateBackCard();
    }
    
    private function checkAuthorization() {
        Auth::check() ?: abort(403);
    }
    
    
    
    private function getStaffInfo($id) {
        if (!$id) {
            throw new \Exception("Missing required field id.");
        }
    
        $staff_info = Staff_prints::findOrFail($id);
        $this->staff = $staff_info;
    }
    
    /**
     * The `position` method sets the value of `$this->position` based on the value of `$this->staff->position`.
     * 
     * @throws \Exception when `$this->staff` is null or not set.
     */
    public function position()
    {
        if (!$this->staff || !$this->staff->staff || !$this->staff->staff->position) {
            throw new \Exception("Staff info not found.");
        }
    
        $position = $this->staff->staff->position;
       
        if ($position == 1) {
            $this->position = 'Staff';
        } elseif ($position == 2) {
            $this->position = 'Admin';
        } elseif ($position == 3) {
            $this->position = 'Owner'; 
        }
    }

    private function getStaffImage() {
        $staff_img = $this->staff->getFirstMedia('staff_print')->getUrl();
        $this->staff_img = $staff_img;
    }
    
    private function splitName() {
        $name = $this->staff->staff->name;
        $parts = explode(" ", $name);
        if (count($parts) > 1) {
            $last_name = array_pop($parts);
            $first_name = implode(" ", $parts);
        } else {
            $first_name = $name;
            $last_name = " ";
        }
        $this->staff_last = $last_name;
        $this->staff_first = $first_name;
    }
    
    private function generateQrCode() {
        $this->qr_logo = $this->qrlogo();
        $qrCode = base64_encode(QrCode::size(250)->eyeColor(0, 237, 28, 36, 0, 0, 0)->eyeColor(1, 237, 28, 36, 0, 0, 0)->eyeColor(2, 237, 28, 36, 0, 0, 0)->eye('circle')->style('square')->format('svg')->generate("Https://$_SERVER[HTTP_HOST]/staff/" . $this->staff->staff->id));
        $this->qrCode = $qrCode;
    }
    
    private function updateStaffStatus() {
        $staff_info = $this->staff->update(['is_active' => 1]);
    }
    
   private function generateExpDate() {
           switch ($this->staff->staff->id_count) {
               case 1:
                   $date = Carbon::now();
                   $date-> addMonths(3);
                   break;
               case 2:
               case 3:
                   $date = Carbon::now();
                   $date->addMonths(6);
                   break;
               default:
                   $date = Carbon::now();
                   $date->addMonths(12);
                   break;
           }
           $exp_date = date('m-Y', strtotime($date));
           $this->exp_date = $exp_date;
       }
    
   private function generateFrontCard() {
       //Front Of Card
       $dom_front = new DOMDocument();
       $dom_front->loadXML(file_get_contents(url('/storage/' . $this->svgfront())));
       $xpath_front = new DOMXPath($dom_front);
       // Find the div element with a specific class
       $elements_front1 = $xpath_front->query("//*[@id='staff_first']");
       $elements_front2 = $xpath_front->query("//*[@id='staff_last']");
       $elements_front3 = $xpath_front->query("//*[@id='exp_date']");
       $elements_front4 = $xpath_front->query("//*[@id='staff_img']");
       $elements_front5 = $xpath_front->query("//*[@id='staff_position']");
       foreach ($elements_front1 as $element_front) {
           $element_front->setAttribute('style', "fill: #231f20; font-family: MyriadPro-Regular, 'Myriad Pro'; font-size: 15px; font-size: min(13px, calc(12px + 0.5vw));;");
           $element_front->nodeValue = $this->staff_first;
       }
       foreach ($elements_front2 as $element_front) {
           $element_front->setAttribute('style', "fill: #231f20; font-family: MyriadPro-Regular, 'Myriad Pro'; font-size: 15px; font-size: min(13px, calc(12px + 0.5vw));");
           $element_front->nodeValue = $this->staff_last;
       }
       foreach ($elements_front3 as $element_front) {
           $element_front->nodeValue = "EXP. " . $this->exp_date;
       }
       foreach ($elements_front4 as $element_back) {
           $element_back->setAttribute('xlink:href', $this->staff_img);
       }
       foreach ($elements_front5 as $element_front) {
        $element_front->nodeValue = $this->position;
    }
       $svg_front =  $dom_front->saveXML();
       $this->svg_front = $svg_front;
   }    
    private function generateBackCard()
    {
        //Back Of Card
        $dom_back = new DOMDocument();
        $dom_back->loadXML(file_get_contents(url('/storage/' . $this->svgback())));
        $xpath_back = new DOMXPath($dom_back);
        // Find the div element with a specific class
        $elements_back = $xpath_back->query("//*[@id='qr_code']");
        foreach ($elements_back as $element_back) {
            // Replace the fill attribute with a new color
            $element_back->setAttribute('xlink:href', 'data:image/svg+xml;base64,' . $this->qrCode);
        }
        $svg_back =  $dom_back->saveXML();
        $this->svg_back = $svg_back;
    }
    public function render()
    {
        return view('livewire.svg', [
            'qrCode' => $this->qrCode,
        ])->layout('layouts.svg');
    }
}
