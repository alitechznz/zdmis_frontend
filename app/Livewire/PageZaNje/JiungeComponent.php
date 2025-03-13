<?php

namespace App\Livewire\PageZaNje;

use Livewire\Component;

class JiungeComponent extends Component
{
    public $isCompleted = false;
    public function render()
    {
        return view('livewire.page-za-nje.jiunge-component');
    }
}
