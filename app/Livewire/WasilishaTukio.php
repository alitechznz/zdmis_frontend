<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class WasilishaTukio extends Component
{
    public $subscribers = [];
    public $contact, $subscription_type, $status, $email, $phone;
    public $subscriber_id;
    // In your Livewire component
    public $isLoading = false;
    public $isCompleted = false;

    public function mount()
    {
       // $this->fetchSubscribers();
    }

    public function subscribe()
    {
        $this->resetLoadingState();
        $this->dispatchBrowserEvent('show-confirmation-modal'); // Trigger modal
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
        $this->isLoading = true;
        $this->isCompleted = false;

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

    private function resetLoadingState()
    {
        $this->isLoading = false;
        $this->isCompleted = false;
    }

    public function fetchSubscribers()
    {

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get(config('services.api.base_url') . '/subscribers');

        if ($response->successful()) {
            $this->subscribers = $response->json();
        }
    }

    public function createSubscriber()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('services.api.base_url') . '/subscriber', [
            'contact' => $this->email,
            'subscription_type' => 'email',
            'status' => 'active',
        ]);

        if ($response->successful()) {
            $this->resetInputFields();
            $this->dispatch('swal:info', title: 'Ahsante kujiunga nasi!');
            // $this->fetchSubscribers();
        } else {
            session()->flash('error', 'Error adding role: ' . $response->body());
        }
    }

    public function createSubscriber_phone()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('services.api.base_url') . '/subscriber', [
            'contact' => $this->phone,
            'subscription_type' => 'phone',
            'status' => 'active',
        ]);

        if ($response->successful()) {
            $this->resetInputFields();
            $this->fetchSubscribers();
        }
    }

    public function submit()
    {
        $this->validate([
            'contact_person' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'municipal_council' => 'required',
            'contact_detail' => 'required|string'
        ]);

        // Process the form submission here after validation passes
    }

    public function render()
    {
        return view('livewire.wasilisha-tukio');
    }
}
