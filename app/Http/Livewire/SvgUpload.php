<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SvgUpload extends Component
{
    public $svgIds = [];

    public function render()
    {
        return view('livewire.svg-upload')->layout('layouts.svg-upload');
    }

    public function storeSvg(Request $request, $file)
    {
        try {
    
            // Read the contents of the uploaded file
            $fileContents = file_get_contents($file->getPathname());
    
            Log::debug('File Contents: ' . $fileContents);
    
            // Extract all the id's from the contents of the file
            preg_match_all('/id="([^"]+)"/', $fileContents, $matches);
    
            // Store the extracted ids
            $this->svgIds = $matches[1];
    
            Log::debug('Stored IDs: ' . implode(',', $this->svgIds));

            Log::debug('Component State: ' . json_encode($this->getPublicPropertiesDefinedBySubClass()));

            $this->emit('refreshComponent');
            dd($this->svgIds);
        } catch (\Exception $e) {
            Log::error('Error while processing uploaded SVG file: ' . $e->getMessage());
        }
    }

    public function fileUploaded(Request $request)
    {
        $uploadedFile = $request->file('file');
        $this->storeSvg($request, $uploadedFile);
    }
}

