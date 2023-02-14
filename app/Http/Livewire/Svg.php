<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\staff_prints;
use app\Settings\BadgeSettings;
use app\Settings\svgIdsSave;
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
    
    public function mount($id, svgIdsSave $settings, BadgeSettings $badgeSettings) {
        $this->checkAuthorization();
        $this->getStaffInfo($id);
        $this->getStaffImage();
        $this->splitName();
        $this->position();
        $this->generateQrCode();
        $this->updateStaffStatus();
        $this->generateExpDate();
        $this->generateFrontCard($settings, $badgeSettings);
        $this->generateBackCard($settings, $badgeSettings);
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
                case 4:
                   $date = Carbon::now();
                   $date->addMonths(12);
                   break;
               default:
                   $date = Carbon::now();
                   $date->addMonths(3);
                   break;
           }
           $exp_date = date('m-Y', strtotime($date));
           $this->exp_date = $exp_date;
       }
    
   private function generateFrontCard(svgIdsSave $settings, BadgeSettings $badgeSettings) {
       //Front Of Card
       $dom_front = new DOMDocument();
       $dom_front->loadXML(file_get_contents(url('/storage/' . $badgeSettings->svg_front)));
       $xpath = new DOMXPath($dom_front);
       $this->elementLogic($xpath, $settings, $badgeSettings);
       $svg_front =  $dom_front->saveXML();
       $this->svg_front = $svg_front;
   }    
    private function generateBackCard(svgIdsSave $settings, BadgeSettings $badgeSettings)
    {
        //Back Of Card
        $dom_back = new DOMDocument();
        $dom_back->loadXML(file_get_contents(url('/storage/' . $badgeSettings->svg_back)));
        $xpath = new DOMXPath($dom_back);
        $this->elementLogic($xpath, $settings, $badgeSettings);
        $svg_back =  $dom_back->saveXML();
        $this->svg_back = $svg_back;
    }
    public function elementLogic($xpath, svgIdsSave $settings, BadgeSettings $badgeSettings){
    
            $selectedOptions = [
                'staff_img' => $settings->db_staff_img,
                'first_name' => $settings->db_first_name,
                'last_name' => $settings->db_last_name,
                'exp_date' => $settings->db_exp_date,
                'staff_position' => $settings->db_staff_position,
                'site_logo' => $settings->db_site_logo,
                'site_logo_big' => $settings->db_site_logo_big,
                'qr_code' => $settings->db_qr_code,
                'phone' => $settings->db_phone,
            ];
    
             // Find the div element with a specific class
            foreach($selectedOptions as $key => $value) {
                $elements = $xpath->query("//*[@id='" . $value . "']");
                switch ($key) {
                   case 'first_name':
                       foreach ($elements as $element) {
                           $element->setAttribute('style', "fill: #231f20; font-family: MyriadPro-Regular, 'Myriad Pro'; font-size: 15px; font-size: min(12px, calc(12px + 0.5vw)); word-wrap: break-word;");
                           $element->nodeValue = $this->staff_first;
                       }
                       break;
                   case 'last_name':
                       foreach ($elements as $element) {
                           $element->setAttribute('style', "fill: #231f20; font-family: MyriadPro-Regular, 'Myriad Pro'; font-size: 15px; font-size: min(12px, calc(12px + 0.5vw)); word-wrap: break-word;");
                           $element->nodeValue = $this->staff_last;
                       }
                       break;
                   case 'exp_date':
                       foreach ($elements as $element) {
                           $element->nodeValue = "EXP. " . $this->exp_date;
                       }
                       break;
                   case 'staff_img':
                        foreach ($elements as $element) {
                            $element->setAttribute('xlink:href', $this->staff_img);
                        }
                       break;
                   case 'staff_position':
                       foreach ($elements as $element) {
                           $element->nodeValue = $this->position;
                       }
                       break;
                   case 'site_logo':
                       foreach ($elements as $element) {
                           $element->setAttribute('xlink:href', url('storage/'.$badgeSettings->site_logo));
                       }
                       break;
                   case 'site_logo_big':
                       foreach ($elements as $element) {
                           $element->setAttribute('xlink:href', url('storage/'.$badgeSettings->site_logo_big));
                       }
                       break;
                   case 'qr_code':
                       foreach ($elements as $element) {
                           $qr_code = base64_encode(QrCode::size(250)->eyeColor(0, 237, 28, 36, 0, 0, 0)->eyeColor(1, 237, 28, 36, 0, 0, 0)->eyeColor(2, 237, 28, 36, 0, 0, 0)->eye('circle')->style('square')->format('svg')->generate($badgeSettings->qr_link));
                           $element->setAttribute('xlink:href', 'data:image/svg+xml;base64,' . $qr_code);
                       }
                       break;
                   case 'phone':
                       foreach ($elements as $element) {
                           $element->nodeValue = "000-000-0000";
                       }
                       break;
                }
            }
        }
    
    public function render()
    {
        return view('livewire.svg', [
            'qrCode' => $this->qrCode,
        ])->layout('layouts.svg');
    }
}
