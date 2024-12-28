<?php

namespace App\Livewire;

use App\Models\Goal;
use App\Models\Pillar;
use App\Models\PriorityArea;
use Livewire\Component;
use Livewire\WithPagination;

class PriorityAreaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword, $search_pillar = null;
    public $update = false;
    public $delete_confirm = null;
    public $set_name;

    public $pillar,$pillars, $category, $name, $link_id, $description, $priorityarea_id, $type = null;

    public $links = [];
    public function mount($type = null, $category = null,)
    {
        $this->category = $category;
        $this->type = $type;
        if ($type == "Regional") {
            $this->pillars = Goal::where('type', $type)->get();
        } else {
            $this->pillars = Pillar::where('category', $category)->get();
        }
        if ($this->category == "middle term"){
            $this->links = PriorityArea::where('category', 'long term')->get();
            $this->set_name = 'Strategic Area';
        } else if ($this->category == "short term"){
            $this->links = PriorityArea::where('category', 'middle term')->get();
            $this->set_name = 'Strategic Area';
        } else {
            $this->set_name = 'Pillar';
        }
    }
    public function fetchFilter()
    {
        if ($this->type == "Regional") {
            $this->pillars = Goal::where('type', $this->type)->get();
        } else {
            $this->pillars = Pillar::where('category', $this->category)->get();
        }
    }
    public function create()
    {
        $this->resetField();
        if ($this->search_pillar){
            $this->pillar = $this->search_pillar;
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:80000',
            'link_id' => ($this->category == "long term" or $this->type = "Regional") ? 'nullable' : 'required',
            'description' => 'required|max:80000',
        ]);
        $this->pillar = $this->search_pillar;
        PriorityArea::updateOrCreate(['id' => $this->priorityarea_id], [
            'pillar_id' => ($this->type == "Regional") ? null : $this->pillar,
            'goal_id' => ($this->type == "Regional") ? $this->pillar : null,
            'name' => $this->name,
            'category' => $this->category,
            'description' => $this->description,
            'type' => $this->type,
        ]);

        $this->dispatch('swal:info', title: $this->priorityarea_id ? 'PriorityArea Updated.' : 'PriorityArea Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($priorityarea_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->priorityarea_id = $priorityarea_id;

        $priorityarea = PriorityArea::findOrFail($priorityarea_id);
        $this->pillar = $priorityarea->pillar;
        $this->name = $priorityarea->name;
        $this->description = $priorityarea->description;
    }

    public function deleteConfirm(PriorityArea $priorityarea)
    {
        $this->delete_confirm = $priorityarea;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'PriorityArea Deleted');
    }

    private function resetField()
    {
        $this->reset('pillar', 'name', 'description', 'priorityarea_id', 'link_id', 'update');
    }

    public function render()
    {
        $priorityareas = PriorityArea::query()->orderBy('id', 'Desc');
        if ($this->type == "Regional" and $this->search_pillar) {
            $priorityareas->where('goal_id', $this->search_pillar );
        } else {
            if ($this->search_pillar == null)
                $this->search_pillar = "";
            $priorityareas->where('pillar_id', $this->search_pillar );
        }
        $priorityareas->when($this->search_keyword, function($query){
            $query->where(function($query){
                $query->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%');
            });
        });
        $priorityareas = $priorityareas->paginate();

        return view('livewire.priority-area-component', [
            'priorityareas' => $priorityareas,
        ])->layout('layouts.app');
    }
}
