<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;


class WasilishaTukio extends Component
{
    public $subscribers = [];
    public $contact, $subscription_type, $status, $email, $phone;
    public $subscriber_id;
    public $contact_person, $phone_number, $tukio, $shehia, $eneo, $latitude, $longitude, $contact_detail, $tukiosababu;
    // In your Livewire component
    public $isLoading = false;
    public $isCompleted = false;

    public $mkoas = [];
    public $ainaTukio = [];
    public $selectedMkoa = null;
    public $selectedTukio = null;
    public $sababu = [];
    public $wilayas = [];
    public $selectedWilaya = null;
    public $shehias  = [];

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
       // dd($mkoa);
        $this->wilayas = [];
        $this->shehias = [];
        $this->selectedWilaya = null;  // Reset selectedWilaya when mkoa changes

        if (!empty($mkoa)) {
            $this->fetchWilayas($mkoa);
        }
    }

    public function updatedSelectedTukio($tukio)
    {
        $this->sababu = [];
        $this->tukiosababu = null;  // Reset selectedWilaya when mkoa changes
        if (!empty($tukio)) {
            $this->fetchSababu($tukio);
        }
    }

    public function fetchSababu($tukio)
    {
        $response = Http::get('https://maafaznz.go.tz/takwimuApi/sababu_api.php', ['janga_id' => $tukio]);
        $this->sababu = $response->json();
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

    public function myFunction()
    {
        // Perform your action here
        dd('Function has been executed successfully!');
    }

    public function submitWasilisha()
    {
        $this->validate([
            'contact_person' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'selectedMkoa' => 'required|string',
            'tukio' => 'required|string',
            'selectedWilaya' => 'required|string',
            'shehia' => 'required|string',
            'eneo' => 'required|string',
            'contact_detail' => 'required|string'
        ]);

        // Process the form submission here after validation passes
    }

    public function render()
    {
        return view('livewire.wasilisha-tukio');
    }
}
