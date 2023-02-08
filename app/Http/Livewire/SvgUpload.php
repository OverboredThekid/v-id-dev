<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class SvgUpload extends Component
{

    use WithFileUploads;
    public $svgContent;
    public $svgIds = [];

    public function render()
    {
        return view('livewire.svg-upload')->layout('layouts.svg-upload');
    }


    public function refreshComponent()
    {
        Log::debug('Refresh component method called');
        $this->svgIds = $this->svgIds;
        $this->emit('refreshComponent');
    }
    

    public function upload()
    {
        $this->validate([
            'svgContent' => 'required|file|mimetypes:image/svg+xml',
        ]);

        $file = $this->svgContent;

        if(empty($file)) {
            return redirect()->back()->withErrors(['svgContent' => 'File could not be uploaded.']);
        }

        $tempUrl = $this->svgContent->temporaryUrl();
        $svgContent = file_get_contents($tempUrl);

        preg_match_all("/<(\w+)\sid=\"(\w+)\"/", $svgContent, $matches);

        $this->svgIds = $matches[2];

        $this->emit('svgIdsLoaded');
    }

}
