<?php

namespace App\Http\Livewire;

use app\Settings\BadgeSettings;
use app\Settings\svgIdsSave;
use LivewireUI\Modal\ModalComponent;
use DOMDocument;
use DOMXPath;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ShowIDs extends ModalComponent
{
    public $svgIds = [];
    public $svgContent = [];
    public $svgSelect = [
        'staff_img' => 'Staff Image',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'exp_date' => 'Expiration Date',
        'staff_position' => 'Staff Position',
        'site_logo' => 'Site Logo',
        'site_logo_big' => 'Site Logo',
        'qr_code' => 'Qr Code',
        'phone' => 'Phone Number',
    ];
    //given form values
    public $staff_img = '', $first_name = '', $last_name = '', $exp_date = '', $staff_position = '', $site_logo = '', $site_logo_big = '', $qr_code = '', $phone = '';
    public $db_staff_img = '', $db_first_name = '', $db_last_name = '', $db_exp_date = '', $db_staff_position = '', $db_site_logo = '', $db_site_logo_big = '', $db_qr_code = '', $db_phone = '';
    public $whichSide;
    public $selectedOptions = [];
    public $side = [];
    public $svg_front, $svg_back;

    public function svgfront(): string
    {
        return app(BadgeSettings::class)->svg_front;
    }
    public function svgback(): string
    {
        return app(BadgeSettings::class)->svg_back;
    }

    public function mount($whichSide, svgIdsSave $settings, BadgeSettings $badge_settings )
    {
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
        
        if ($whichSide == 1) {

            $svgContent = file_get_contents(url('/storage/' . $badge_settings->svg_front));

            preg_match_all("/<(text|image)\sid=\"(\w+)\"/", $svgContent, $matches);

            $this->svgIds = $matches[2]; //List of Uploaded ID's
            $this->whichSide = "Front"; //Title
            $this->svgContent = $svgContent; //Svg File Content
            $this->side = $this->svgSelect; //List of Given ID's
            $this->selectedOptions = $selectedOptions;  //List of DB Values
            $this->loadForm($settings);

        } elseif ($whichSide == 2) {
            $svgContent = file_get_contents(url('/storage/' . $this->svgback()));

            preg_match_all("/<(text|image)\sid=\"(\w+)\"/", $svgContent, $matches);

            $this->svgIds = $matches[2]; //List of Uploaded ID's
            $this->whichSide = "Back"; //Title
            $this->svgContent = $svgContent; //Svg File Content
            $this->side = $this->svgSelect; //List of Given ID's
            $this->selectedOptions = $selectedOptions; //List of DB Values
            $this->loadForm($settings);
        }
    }
    public function logic($selectedOptions)
    {
        $dom = new DOMDocument();
        $dom->loadXML($this->svgContent);
        $xpath = new DOMXPath($dom);

        // Find the div element with a specific class
        $elements_1 = $xpath->query("//*[@id='" . $selectedOptions['first_name'] . "']");
        $elements_2 = $xpath->query("//*[@id='" . $selectedOptions['last_name'] . "']");
        $elements_3 = $xpath->query("//*[@id='" . $selectedOptions['exp_date'] . "']");
        $elements_4 = $xpath->query("//*[@id='" . $selectedOptions['staff_img'] . "']");
        $elements_5 = $xpath->query("//*[@id='" . $selectedOptions['staff_position'] . "']");
        $elements_6 = $xpath->query("//*[@id='" . $selectedOptions['site_logo'] . "']");
        $elements_7 = $xpath->query("//*[@id='" . $selectedOptions['site_logo_big'] . "']");
        $elements_8 = $xpath->query("//*[@id='" . $selectedOptions['qr_code'] . "']");
        $elements_9 = $xpath->query("//*[@id='" . $selectedOptions['phone'] . "']");

        //Filler Elements
        foreach ($elements_1 as $element) {
            $element->setAttribute('style', "fill: #231f20; font-family: MyriadPro-Regular, 'Myriad Pro'; font-size: 15px; font-size: min(13px, calc(12px + 0.5vw));;");
            $element->nodeValue = "Jon";
        }
        foreach ($elements_2 as $element) {
            $element->setAttribute('style', "fill: #231f20; font-family: MyriadPro-Regular, 'Myriad Pro'; font-size: 15px; font-size: min(13px, calc(12px + 0.5vw));");
            $element->nodeValue = "Doe";
        }
        foreach ($elements_3 as $element) {
            $element->nodeValue = "EXP. " . "00/0000";
        }
        foreach ($elements_4 as $element) {
            $element->setAttribute('xlink:href', "#Staff Image");
        }
        foreach ($elements_5 as $element) {
            $element->nodeValue = "Staff!";
        }
        foreach ($elements_6 as $element) {
            $element->setAttribute('xlink:href', "#Site_logo");
        }
        foreach ($elements_7 as $element) {
            $element->setAttribute('xlink:href', "#Site_logo_big");
        }
        foreach ($elements_8 as $element) {
            $qr_code = base64_encode(QrCode::size(250)->eyeColor(0, 237, 28, 36, 0, 0, 0)->eyeColor(1, 237, 28, 36, 0, 0, 0)->eyeColor(2, 237, 28, 36, 0, 0, 0)->eye('circle')->style('square')->format('svg')->generate("ID Has Been Added!"));
            $element->setAttribute('xlink:href', 'data:image/svg+xml;base64,' . $qr_code);
        }
        foreach ($elements_9 as $element) {
            $element->nodeValue = "000-000-0000";
        }
        $svg = $dom->saveXML();
        $this->svgContent = $svg;
    }
    public function submitForm(svgIdsSave $settings)
{   //Form Values
    $selectedOptions = [
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
        'exp_date' => $this->exp_date,
        'staff_img' => $this->staff_img,
        'staff_position' => $this->staff_position,
        'site_logo' => $this->site_logo,
        'site_logo_big' => $this->site_logo_big,
        'qr_code' => $this->qr_code,
        'phone' => $this->phone,
    ];

    $this->logic($selectedOptions);

    //Saving Values To Server
    if (!empty($selectedOptions['staff_img'])) {
        $settings->db_staff_img = $selectedOptions['staff_img'];
    }
    if (!empty($selectedOptions['first_name'])) {
        $settings->db_first_name = $selectedOptions['first_name'];
    }
    if (!empty($selectedOptions['last_name'])) {
        $settings->db_last_name = $selectedOptions['last_name'];
    }
    if (!empty($selectedOptions['exp_date'])) {
        $settings->db_exp_date = $selectedOptions['exp_date'];
    }
    if (!empty($selectedOptions['staff_position'])) {
        $settings->db_staff_position = $selectedOptions['staff_position'];
    }
    if (!empty($selectedOptions['qr_code'])) {
        $settings->db_qr_code = $selectedOptions['qr_code'];
    }
    if (!empty($selectedOptions['phone'])) {
        $settings->db_phone = $selectedOptions['phone'];
    }
    if (!empty($selectedOptions['site_logo'])) {
        $settings->db_site_logo = $selectedOptions['site_logo'];
    }
    if (!empty($selectedOptions['site_logo_big'])) {
        $settings->db_site_logo_big = $selectedOptions['site_logo_big'];
    }

    $settings->save();
}


    public function loadForm(svgIdsSave $settings)
    {
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

        $this->logic($selectedOptions);

    }


    public function render()
    {
        return view('livewire.show-i-ds');
    }
}
