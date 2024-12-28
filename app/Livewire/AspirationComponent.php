<?php

namespace App\Livewire;

use App\Models\Aspiration;
use App\Models\Plan;
use App\Models\PriorityArea;
use Livewire\Component;
use Livewire\WithPagination;

class AspirationComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword, $search_priority = null;
    public $update = false;
    public $delete_confirm = null;
    public $set_name;

    public $name, $priority_area, $category, $link_id, $type, $priorities, $aspiration_id = null;
    public $links = [];
    public function mount($type, $category)
    {
        $this->category = $category;
        $this->type = $type;
        if ($type == "Regional"){
            $this->priorities = Plan::where('type', $type)->get();
        } else {
            $this->priorities = PriorityArea::where('category', $category)->get();
        }
//        if ($this->category == "middle term"){
//            $this->links = Aspiration::where('category', 'long term')->get();
//            $this->set_name = 'Strategic Intervention';
//        } else if ($this->category == "short term"){
//            $this->links = Aspiration::where('category', 'middle term')->get();
//            $this->set_name = 'Strategic Intervention';
//        } else {
//            $this->set_name = 'Aspiration';
//        }
    }
    public function fetchFilter()
    {
        if($this->type == "Regional"){
            $this->priorities = Plan::where('type', $this->type)->get();
        } else {
            $this->priorities = PriorityArea::where('category', $this->category)->get();
        }
    }
    public function create()
    {
        $this->resetField();
        if ($this->search_priority){
            $this->priority_area = $this->search_priority;
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:30000',
//            'link_id' => ($this->category == "long term") ? 'nullable' : 'required',
        ]);
        $this->priority_area = $this->search_priority;
        Aspiration::updateOrCreate(['id' => $this->aspiration_id], [
            'name' => $this->name,
            'category' => $this->category,
            'priority_area_id' => ($this->type == "Regional") ? null : $this->priority_area,
            'plan_id' => ($this->type == "Regional") ? $this->priority_area : null,
            'link_id' => $this->link_id,
            'type' => $this->type,
        ]);

        $this->dispatch('swal:info', title: $this->aspiration_id ? 'Aspiration Updated.' : 'Aspiration Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($aspiration_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->aspiration_id = $aspiration_id;

        $aspiration = Aspiration::findOrFail($aspiration_id);
        $this->name = $aspiration->name;
        $this->priority_area = $aspiration->priority_area;
        $this->link_id = $aspiration->link_id;
    }

    public function deleteConfirm(Aspiration $aspiration)
    {
        $this->delete_confirm = $aspiration;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Aspiration Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'priority_area', 'aspiration_id','link_id', 'update');
    }

    public function render()
    {
        $aspirations = Aspiration::query()->orderBy('id', 'desc');

        if ($this->type == "Regional" and $this->search_priority){
            $aspirations->where('plan_id', $this->search_priority);
        } else {
            if ($this->search_priority == null)
                $this->search_priority = "";
            $aspirations->where('priority_area_id', $this->search_priority);
        }
        $aspirations->when($this->search_keyword, function($query){
            $query->where(function($query){
                $query->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%');
            });
        });

        $aspirations = $aspirations->paginate();

        return view('livewire.aspiration-component', [
            'aspirations' => $aspirations,
        ])->layout('layouts.app');
    }
}
