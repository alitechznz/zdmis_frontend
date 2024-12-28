<?php

namespace App\Livewire;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class PlanComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $code, $type, $category, $plan_period_type, $start_date, $end_date, $description, $plan_id = null;

    public function mount($type, $category = null)
    {
        $this->type = $type;
        if ($type == "National"){
            $this->category = $category;
        }
    }
    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required|max:3000',
        ]);
        Plan::updateOrCreate(['id' => $this->plan_id], [
            'name' => $this->name,
            'code' => $this->code,
            'type' => $this->type,
            'category' => $this->category,
            'plan_period_type' => $this->category,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
        ]);

        $this->dispatch('swal:info', title: $this->plan_id ? 'Plan Updated.' : 'Plan Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($plan_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->plan_id = $plan_id;

        $plan = Plan::findOrFail($plan_id);
        $this->name = $plan->name;
        $this->code = $plan->code;
        $this->type = $plan->type;
        $this->plan_period_type = $plan->plan_period_type;
        $this->start_date = $plan->start_date;
        $this->end_date = $plan->end_date;
        $this->description = $plan->description;
    }

    public function deleteConfirm(Plan $plan)
    {
        $this->delete_confirm = $plan;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Plan Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'code', 'start_date', 'end_date', 'description', 'plan_id', 'update');
    }

    public function render()
    {
        $plans = Plan::select()->orderBy('id', 'DESC')
            ->where('type', $this->type)
            ->where('category', $this->category)
            ->when($this->search_keyword, function ($query) {
                $query->where(function($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('code', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('start_date', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('end_date', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('status', 'like', '%' . $this->search_keyword . '%');
                });
            })->paginate(10);

        return view('livewire.plan-component', [
            'plans' => $plans
        ])->layout('layouts.app');
    }
}
