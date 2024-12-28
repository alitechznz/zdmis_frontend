<?php

namespace App\Livewire;

use App\Models\Pillar;
use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class PillarComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['planChanged' => 'onPlanChanged'];

    public $search_keyword, $search_plan = null;
    public $update = false;
    public $delete_confirm = null;

    public $set_name;

    public $name, $plan, $plans, $type, $category,$link_id, $description, $pillar_id = null;
    public $plan_id = 0;

    public $links = [];
    public function mount($type, $category)
    {
        $this->category = $category;
        if($this->category =='long term'){
            $this->set_name = 'Pillar';
        } else {
            $this->set_name = 'Strategic area';
        }
        $this->type = $type;
        $this->plans = Plan::where('category', $category)->get();
    }
    public function fetchFilter()
    {

        $this->plans = Plan::where('category', $this->category)->get();
    }
    public function create()
    {

        $this->resetField();
        if ($this->search_plan){
            $this->plan = $this->search_plan;
        }

        if ($this->category == "middle term"){
            $this->links = Pillar::where('category', 'long term')->orderBy('name')->get();
            $this->set_name = 'Strategic Area';
        } else if ($this->category == "short term"){
            $this->links = Pillar::where('category', 'middle term')->orderBy('name')->get();
            $this->set_name = 'Strategic Area';
        } else {
            $this->set_name = 'Pillar';
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'link_id' => ($this->category == "long term") ? 'nullable' : 'required',
            'description' => 'required|max:3000',
        ]);
        $this->plan = $this->search_plan;
        Pillar::updateOrCreate(['id' => $this->pillar_id], [
            'name' => $this->name,
            'plan_id' => $this->plan,
            'type' => $this->type,
            'link_id' => $this->link_id,
            'category' => $this->category,
            'description' => $this->description,
        ]);

        $this->dispatch('swal:info', title: $this->pillar_id ? 'Pillar Updated.' : 'Pillar Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($pillar_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->pillar_id = $pillar_id;

        $pillar = Pillar::findOrFail($pillar_id);
        $this->name = $pillar->name;
        $this->plan = $pillar->plan_id;
        $this->description = $pillar->description;
    }

    public function deleteConfirm(Pillar $pillar)
    {
        $this->delete_confirm = $pillar;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Pillar Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'plan', 'link_id', 'description', 'pillar_id', 'update');
    }

     public function render()
     {
        $pillars = Pillar::where('plan_id', $this->search_plan)
                    ->where('category', $this->category)
                    ->when($this->search_keyword, function ($query) {
                        $query->where(function($query) {
                            $query->where('id', $this->search_keyword)
                                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')
                                ->orWhere('status', 'like', '%' . $this->search_keyword . '%')
                                ->orWhere('description', 'like', '%' . $this->search_keyword . '%');
                        });
                    })->orderBy('name')->paginate(10);

        //  $pillars = Pillar::select()->orderBy('name')
        //      ->where('plan_id', $this->search_plan)
        //      ->where('category', $this->category)
        //      ->when($this->search_keyword, function ($query) {
        //          $query->where(function($query) {
        //              $query->where('id', $this->search_keyword)
        //              ->orWhere('name', 'like', '%' . $this->search_keyword . '%')
        //              ->orWhere('status', 'like', '%' . $this->search_keyword . '%')
        //              ->orWhere('description', 'like', '%' . $this->search_keyword . '%');
        //          });
        //      })->paginate(10);

         return view('livewire.pillar-component', [
             'pillars' => $pillars,
         ])->layout('layouts.app');
     }
}
