<?php

namespace App\Livewire;

use Livewire\Component;

class DisbursingComponent extends Component
{

               // Remove commas for the numeric conversion if there are any
            //    $formattedAmount = str_replace(',', '', $this->amount);
               // Optionally, convert to a number to ensure it's stored as numeric in the database
            //    $formattedAmount = (float) $formattedAmount;

    public function render()
    {
        return view('livewire.disbursing-component')->layout('layouts.app');
    }
}