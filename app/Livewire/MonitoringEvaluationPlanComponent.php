<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class MonitoringEvaluationPlanComponent extends Component
{


    // use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $action, $code, $remark;


    public function render()
    {
        // logger()->info('Rendering the M & E Plan Component');
        return view('livewire.monitoring-evaluation-plan-component')->layout('layouts.app');
    }
}
