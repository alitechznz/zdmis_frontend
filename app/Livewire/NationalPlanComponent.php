<?php

namespace App\Livewire;

use App\Models\Aspiration;
use App\Models\Baseline;
use App\Models\KPI;
use App\Models\Pillar;
use App\Models\Plan;
use App\Models\PriorityArea;
use App\Models\Target;
use Livewire\Component;
use Livewire\WithPagination;

class NationalPlanComponent extends Component
{
    public $is_plan, $is_pillar, $is_p_area, $is_aspiration, $is_kpi, $is_baseline, $is_target = false;

    public $is_md_plan = true, $is_md_pillar, $is_md_p_area, $is_md_aspiration, $is_md_kpi, $is_md_baseline, $is_md_target = false;
    public $activeTab = 'long_term';

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.national-plan-component')->layout('layouts.app');
    }
}
