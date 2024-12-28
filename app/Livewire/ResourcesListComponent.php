<?php

namespace App\Livewire;

use App\Models\FinanceParticular;
use App\Models\Project;
use App\Models\SourceFinancing;
use Livewire\Component;

class ResourcesListComponent extends Component
{
    public function render()
    {
        return view('livewire.resources-list-component', [
            'finance_particulars' => FinanceParticular::all(),
            'source_finances' => SourceFinancing::all(),
            'projects' => Project::all(),
        ])->layout('layouts.app');
    }
}
