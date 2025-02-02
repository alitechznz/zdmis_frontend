<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;


class Login extends Component
{

    public $emails = '';
    public $password = '';

    public function submit()
    {
        dd($this->email);
        exit();
        $baseUrl = config('services.api.base_url'); // Retrieve the base URL from configuration

        $response = Http::post("{$baseUrl}/login", [
            'username' => $this->email,
            'password' => $this->password,
        ]);



        if ($response->successful()) {
            $data = $response->json();
            session(['token' => $data['data']['token']]);  // Storing token in session
            $this->emit('loginSuccess');
            return redirect()->to('/home');  // Redirecting to a dashboard or another necessary route
        } else {
            $this->addError('email', 'The provided credentials are incorrect.');
        }
    }


    public function render()
    {
        return view('livewire.login')->layout('layouts.guest');
    }
}
