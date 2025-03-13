<?php

namespace App\Livewire;

use Livewire\Component;

class WeatherDataFeedComponent extends Component
{

    public function create(){

    }
    public function render()
    {
        return view('livewire.weather-data-feed-component')->layout('layouts.app');
    }
}
