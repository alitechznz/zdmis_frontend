<?php

namespace App\Livewire;

use App\Models\Aspiration;
use App\Models\Baseline;
use App\Models\Goal;
use App\Models\PriorityArea;
use App\Models\Target;
use App\Models\Unit;
use App\Models\UnitValue;
use Livewire\Component;
use Livewire\WithPagination;

class TargetComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword, $search_baseline = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $baseline,$baselines, $category,$type, $link_id, $unit, $value, $year, $target_id = null;

    public $links = [];
    public function mount($type = null, $category = null)
    {
        $this->category = $category;
        $this->type = $type;
        if ($type == "International") {
            $this->baselines = Goal::where('type', $type)->get();
        } else if($type == "Regional") {
            $this->baselines = PriorityArea::where('type', $type)->get();
        } else {
            $this->baselines = Baseline::where('category', $category)->orderBy('name')->get();
        }

//        if ($this->category == "middle term"){
//            $this->links = Target::where('category', 'long term')->get();
//        } else if ($this->category == "short term"){
//            $this->links = Target::where('category', 'middle term')->get();
//        }
    }
    public function fetchFilter()
    {
        if ($this->type == "International") {
            $this->baselines = Goal::where('type', $this->type)->get();
        } else if($this->type == "Regional") {
            $this->baselines = PriorityArea::where('type', $this->type)->get();
        } else {
            $this->baselines = Baseline::where('category', $this->category)->orderBy('name')->get();
        }
    }
    public function create()
    {
        $this->resetField();
        if ($this->search_baseline){
            $this->baseline = $this->search_baseline;
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:240',
            'unit' => 'required',
            'value' => 'required|max:1000',
            'year' => 'required|digits:4|integer|min:1900',
//            'link_id' => ($this->category == "long term" or $this->category == null) ? 'nullable' : 'required',
        ]);

        $this->baseline = $this->search_baseline;
        Target::updateOrCreate(['id' => $this->target_id], [
            'name' => $this->name,
            'baseline_id' => ($this->type == "National") ? $this->baseline : null,
            'goal_id' => ($this->type == "International") ? $this->baseline : null,
            'priority_area_id' => ($this->type == "Regional") ? $this->baseline : null,
            'category' => $this->category,
            'type' => $this->type,
            'unit_id' => $this->unit,
            'value' => $this->value,
            'link_id' => $this->link_id,
            'year' => $this->year,
        ]);

        $this->dispatch('swal:info', title: $this->target_id ? 'Target Updated.' : 'Target Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($target_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->target_id = $target_id;

        $target = Target::findOrFail($target_id);
        $this->name = $target->name;
        $this->baseline = $target->baseline_id;
        $this->unit = $target->unit_id;
        $this->value = $target->value;
        $this->year = $target->year;
    }

    public function deleteConfirm(Target $target)
    {
        $this->delete_confirm = $target;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Target Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'baseline', 'unit', 'value', 'year', 'target_id', 'update', 'link_id');
    }

    public function render()
    {
        $targets = Target::query()->with('unitValue')->orderBy('id', 'DESC');
        if ($this->type == "International" and $this->search_baseline) {
            $targets->where('goal_id', $this->search_baseline);
        } else if($this->type == "Regional" and $this->search_baseline) {
            $targets->where('priority_area_id', $this->search_baseline);
        } else {
            if ($this->search_baseline == null) $this->search_baseline = "";
            $targets->where('baseline_id', $this->search_baseline);
        }
        $targets->when($this->search_keyword, function ($query){
            $query->where(function($query){
                    $query->orWhere('name', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('unit_id', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('value', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('year', 'like', '%' . $this->search_keyword . '%');
            });
        });
        $targets = $targets->paginate(10);


        return view('livewire.target-component', [
            'targets' => $targets,
            'units' => UnitValue::all(),
        ])->layout('layouts.app');
    }
}
