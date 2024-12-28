<?php

namespace App\Livewire;

use App\Models\Ministry;
use App\Models\Project;
use Livewire\Component;

class MonitoringComponent extends Component
{
    // Remove commas for the numeric conversion if there are any
    //    $formattedAmount = str_replace(',', '', $this->amount);
    // Optionally, convert to a number to ensure it's stored as numeric in the database
    //    $formattedAmount = (float) $formattedAmount;
    public function render()
    {
        return view('livewire.monitoring-component', [
            'projects' => Project::all(),
            'ministries' => Ministry::all(),
        ])->layout('layouts.app');
    }
}