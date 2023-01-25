<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use app\Models\Bookstack;

class HowTo extends Component
{
    public function retrieveBookstack()
    {
        $client = new Client();
    
        $response = $client->get('https://wiki.v-id.dev/api/pages/7', [
            'headers' => [
                'Authorization' => 'Token 2C0QC7d2Gy2tS92agBzOBNMQ92gjlhEG:RwLyat52Chg7GSRvH38rnE1658SWoJPK'
            ]
        ]);
    
        $bookstack = json_decode($response->getBody());
        return $bookstack;
    }   

    public function render()
    {
        $bookstack = (new HowTo())->retrieveBookstack();
        return view('livewire.how-to', compact('bookstack'))->layout('layouts.HowTo');
    }

}
