<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;


class Login extends Component
{

    public $email = '';
    public $password = '';

    public function submit()
    {
        $baseUrl = config('services.api.base_url'); // Ensure this URL is correct and reachable
        // Trim the username and password to remove any leading/trailing white spaces
        // dd($baseUrl);

        $payload = [
            'email' => trim($this->email),  // Assuming this property holds the correct value
            'password' => trim($this->password),
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json', // Make sure the server expects and handles JSON properly
        ])->post("{$baseUrl}/users/login", $payload);


        // dd($response->body(), $response->status(), $response->json(), $payload);

        // if ($response->successful()) {
        //     $data = $response->json();
        //     $token = $data['data']['tokenData']['token'];
        //     session(['token' => $token]); // Store the token in the session
        //     // session(['token' => $data['data']['token']]);
        //     // $this->emit('loginSuccess');
        //     return redirect()->to('/dashboard');
        // } else {
        //     $this->addError('email', 'The provided credentials are incorrect or authentication failed.');
        // }

        if ($response->successful()) {
            $data = $response->json();
            $token = $data['token']; // Directly access the token
            session(['token' => $token]); // Store the token in the session
            // $this->emit('loginSuccess'); // Uncomment if you need to emit an event
            return redirect()->to('/dashboard');
        } else {
            $this->addError('email', 'The provided credentials are incorrect or authentication failed.');
        }
    }


    public function render()
    {
        return view('livewire.login');
    }
}
