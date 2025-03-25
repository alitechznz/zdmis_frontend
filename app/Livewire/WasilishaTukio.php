<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class WasilishaTukio extends Component
{
    public $subscribers = [];
    public $contact, $subscription_type, $status, $email, $phone;
    public $subscriber_id;
    public $contact_person, $phone_number, $tukio, $shehia, $eneo, $latitude, $longitude, $contact_detail;
    // In your Livewire component
    public $isLoading = false;
    public $isCompleted = false;

    public $mkoas = [];
    public $ainaTukio = [];
    public $selectedMkoa = null;
    public $wilayas = [];
    public $selectedWilaya = null;
    public $shehias  = [];

    public $contact_person, $phone_number, $municipal_council, $contact_detail;
    public function mount()
    {
        $this->fetchTukioAina();
        $this->fetchMkoas();
    }

    public function fetchMkoas()
    {
        $response = Http::get('https://maafaznz.go.tz/takwimuApi/mkoa.php');
        $this->mkoas = $response->json();  // Assuming the endpoint returns a JSON array
        //dd($this->mkoas);
    }

    public function fetchTukioAina()
    {
        $response = Http::get('https://maafaznz.go.tz/takwimuApi/aina_api.php');
        $this->ainaTukio = $response->json();  // Assuming the endpoint returns a JSON array
        //dd($this->mkoas);
    }

    public function updatedSelectedMkoa($mkoa)
    {
        $this->wilayas = [];
        $this->shehias = [];
        $this->selectedWilaya = null;  // Reset selectedWilaya when mkoa changes

        if (!empty($mkoa)) {
            $this->fetchWilayas($mkoa);
        }
    }

    public function fetchWilayas($mkoa)
    {
        $response = Http::get('https://maafaznz.go.tz/takwimuApi/wilaya.php', ['mkoa' => $mkoa]);
        $this->wilayas = $response->json();
    }

    public function updatedSelectedWilaya($wilaya)
    {
        $this->shehias = [];

        if (!empty($wilaya)) {
            $this->fetchShehias($wilaya);
        }
    }

    public function fetchShehias($wilaya)
    {
        $response = Http::get('https://maafaznz.go.tz/takwimuApi/shehia.php', ['wilaya' => $wilaya]);
        $this->shehias = $response->json();
    }

    public function submitWasilish()
    {
        $this->validate([
            'contact_person' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'contact_detail' => 'required|string'
        ]);

        // Process the form submission here after validation passes
    }

    public function render()
    {
        return view('livewire.wasilisha-tukio');
    }
}
