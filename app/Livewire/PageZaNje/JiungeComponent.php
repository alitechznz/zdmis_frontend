<?php

namespace App\Livewire\PageZaNje;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class JiungeComponent extends Component
{
    public $subscribers = [];
    public $email, $phone;
    public $isLoading = false;
    public $isCompleted = false;

    public $isLoading_p = false;
    public $isCompleted_p = false;

    public function validateAndShowModal($type)
    {
        if ($type == 'email' && $this->email) {
            $this->validate(['email' => 'required|email']);
            $this->emit('showModal');
        } elseif ($type == 'phone' && $this->phone) {
            $this->validate(['phone' => 'required|digits:10']); // Update validation as necessary
            $this->emit('showModal');
        } else {
            session()->flash('error', 'Tafadhali ingiza nambari yako ya simu au barua pepe');
        }
    }
   
    public function confirmSubscription()
    {
        $this->isLoading = true;
        $this->isCompleted = false;

        // Simulate a request...
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('services.api.base_url') . '/subscriber/activate', [
            'contact' => $this->email,
            'subscription_type' => 'email',
            'status' => 'active',
        ]);

        if ($response->successful()) {
            // $this->resetInputFields();
            $this->dispatch('swal:info', title: 'Ahsante kujiunga nasi!');
           // $this->dispatch('refreshPage');
            // $this->fetchSubscribers();
        } else {
            // session()->flash('error', 'Error adding role: ' . $response->body());
            $this->dispatch('swal:info', title: $response->body());
        }

        // sleep(2); // Do your API call or other operations here

        $this->isLoading = false;
        $this->isCompleted = true;

        // Close modal after action
        // $this->dispatch('swal:info', title: 'Ahsante kujiunga nasi!');
        // $this->dispatchBrowserEvent('close-confirmation-modal');
    }

    public function confirmSubscription_p()
    {
        $this->isLoading_p = true;
        $this->isCompleted_p = false;

        // Simulate a request...

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('services.api.base_url') . '/subscriber/activate', [
            'contact' => $this->phone,
            'subscription_type' => 'phone',
            'status' => 'active',
        ]);

        // dd($response);
        if ($response->successful()) {
            // $this->resetInputFields();
            $this->dispatch('swal:info', title: 'Ahsante kujiunga nasi!');
            //$this->dispatchBrowserEvent('refreshPage');
            // $this->fetchSubscribers();
        } else {
            // session()->flash('error', 'Error adding role: ' . $response->body());
            $this->dispatch('swal:info', title: $response->body());
        }

        // sleep(2); // Do your API call or other operations here

        $this->isLoading_p = false;
        $this->isCompleted_p = true;

        // Close modal after action
        // $this->dispatch('swal:info', title: 'Ahsante kujiunga nasi!');
        // $this->dispatchBrowserEvent('close-confirmation-modal');
    }


    public function render()
    {
        return view('livewire.page-za-nje.jiunge-component');
    }
}
