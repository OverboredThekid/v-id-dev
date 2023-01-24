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
    
        $response = $client->get('http://wiki.v-id.dev/api/v1/pages/', [
            'headers' => [
                'Authorization' => 'IK1OH27QV17OUPCuZdSUfc9aNZUka34m'
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
