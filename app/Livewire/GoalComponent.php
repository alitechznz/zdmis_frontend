<?php

namespace App\Livewire;

use App\Models\Aspiration;
use App\Models\Goal;
use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class GoalComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword, $search_plan = null;
    public $update = false;
    public $delete_confirm = null;

    public $name,$plan, $plans, $type, $description, $goal_id = null;

    public function mount($type)
    {
        $this->type = $type;
        if ($this->type == 'Regional') {
            $this->plans = Aspiration::where('type', $this->type)->get();
        } else {
            $this->plans = Plan::where('type', $this->type)->get();
        }
    }
    public function fetchFilter()
    {
        if ($this->type == 'Regional') {
            $this->plans = Aspiration::where('type', $this->type)->get();
        } else {
            $this->plans = Plan::where('type', $this->type)->get();
        }
    }
    public function create()
    {
        $this->resetField();
        if ($this->search_plan){
            $this->plan = $this->search_plan;
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required|max:3000',
        ]);
        Goal::updateOrCreate(['id' => $this->goal_id],[
            'name' => $this->name,
            'plan_id' => ($this->type == "Regional") ? null : $this->plan,
            'aspiration_id' => ($this->type == "Regional") ? $this->plan : null,
            'type' => $this->type,
            'description' => $this->description,
        ]);

        $this->dispatch('swal:info', title: $this->goal_id ? 'Goal Updated.' : 'Goal Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($goal_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->goal_id = $goal_id;

        $goal = Goal::findOrFail($goal_id);
        $this->name = $goal->name;
        $this->plan = $goal->plan_id;
        $this->description = $goal->description;
    }

    public function deleteConfirm(Goal $goal){
        $this->delete_confirm = $goal;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Goal Deleted');
    }

    private function resetField(){
        $this->reset('name','description', 'goal_id' , 'update');
    }

    public function render()
    {
        $goals = Goal::query()->with('plan')->orderBy('id', 'DESC');

        if ($this->type == 'Regional' and $this->search_plan) {
            $goals->where('aspiration_id', $this->search_plan);
        } else {
            if ($this->search_plan == null)
                $this->search_plan = "";
            $goals->where('plan_id', $this->search_plan);
        }
        $goals->when($this->search_keyword, function ($query) {
            $query->where(function ($query) {
                $query->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%'.$this->search_keyword.'%');
            });
        } );

        $goals = $goals->paginate();


        return view('livewire.goal-component', [
            'goals' => $goals
        ])->layout('layouts.app');
    }
}
