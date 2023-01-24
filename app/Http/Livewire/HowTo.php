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
    
        $response = $client->get('http://wiki.v-id.dev/api/pages/instructions', [
            'headers' => [
                'authorization' => '2C0QC7d2Gy2tS92agBzOBNMQ92gjlhEG:RwLyat52Chg7GSRvH38rnE1658SWoJPK'
            ]
        ]);
    
        $bookstack = json_decode($response->getBody());
        return $bookstack;
    }
    public function storeBookstack($bookstack)
    {
        // Store the data in the database or file system, depending on your specific use case.
        // Example:
        $storedBookstack = new Bookstack();
        $storedBookstack->content = $bookstack;
        $storedBookstack->save();
    }
    
    public function getBookstack()
    {
        // Retrieve the data from the database or file system, depending on your specific use case.
        // Example:
        $storedBookstack = Bookstack::first();
        return $storedBookstack->content;
    }

    public function synchronizeBookstack()
{
    $bookstack = $this->retrieveBookstack();
    $this->storeBookstack($bookstack);
}

    

    public function render()
    {
        $bookstack = (new HowTo())->retrieveBookstack();
        return view('livewire.how-to', compact('bookstack'));
    }

}
