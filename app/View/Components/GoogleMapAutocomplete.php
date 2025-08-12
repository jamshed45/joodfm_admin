<?php
namespace App\View\Components;

use Illuminate\View\Component;

class GoogleMapAutocomplete extends Component
{
    public ?string $apiKey;
    public ?string $address;
    public ?string $lat;
    public ?string $long;

    public function __construct(string $apiKey, ?string $address = null, ?string $lat = null, ?string $long = null)
    {
        $this->apiKey  = $apiKey;
        $this->address = $address;
        $this->lat     = $lat;
        $this->long    = $long;
    }

    public function render()
    {
        return view('components.google-map-autocomplete');
    }
}
