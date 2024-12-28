<?php

namespace App\Livewire;

use App\Models\Aspiration;
use App\Models\Goal;
use App\Models\KPI;
use App\Models\PriorityArea;
use App\Models\Target;
use Livewire\Component;
use Livewire\WithPagination;

class KpiComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword, $search_aspiration = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $aspiration, $category, $priority, $kpi_definition, $link_id, $type, $kpi_id = null;
    public $links = [], $priority_areas = [], $aspirations = [];
    public function mount($type = null, $category = null, )
    {
        // $this->aspirations = Aspiration::where('category', $category)->get();
        $this->category = $category;
        $this->type = $type;

        if ($type == "International" or $type == "Regional") {
            $this->aspirations = Target::where('type', $type)->get();
        }  else {
            $this->aspirations = PriorityArea::where('category', $category)->get();
        }

        if ($this->category == "middle term"){
            $this->links = KPI::where('category', 'long term')->get();
        } else if ($this->category == "short term"){
            $this->links = KPI::where('category', 'middle term')->get();
        }
    }

    public function updatedPriority()
    {
        $this->links = KPI::where('priority_area_id', $this->priority)->get();

    }
    public function fetchFilter()
    {
        // $this->aspirations = Aspiration::where('category', $this->category)->get();
        if ($this->type == "International" or $this->type == "Regional") {
            $this->priority_areas = PriorityArea::where('category', "middle term")->get();
            $this->aspirations = Target::where('type', $this->type)->get();
        }  else {
            $this->aspirations = PriorityArea::where('category', $this->category)->get();
        }
    }
    public function create()
    {
        $this->resetField();
        if ($this->search_aspiration){
            $this->aspiration = $this->search_aspiration;
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:3000',
            'link_id' => ($this->category == "long term" or $this->type == "Regional") ? 'nullable' : 'required',
        ]);
        $this->aspiration = $this->search_aspiration;
        KPI::updateOrCreate(['id' => $this->kpi_id], [
            'name' => $this->name,
            // 'aspiration_id' => $this->aspiration,
            'priority_area_id' => ($this->type == "National") ? $this->aspiration : null,
            'target_id' => ($this->type == "National") ? null : $this->aspiration,
            'type' => $this->type,
            'category' => $this->category,
            'link_id' => $this->link_id,
            'kpi_definition' => $this->kpi_definition,
        ]);
        $this->dispatch('swal:info', title: $this->kpi_id ? 'KPI Updated.' : 'KPI Created');
        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($kpi_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->kpi_id = $kpi_id;

        $kpi = KPI::findOrFail($kpi_id);
        $this->name = $kpi->name;
        $this->aspiration = $kpi->aspiration_id;
        $this->kpi_definition = $kpi->kpi_definition;
        $this->link_id = $kpi->link_id;
        $this->priority = $kpi->priority_area_id;
    }

    public function deleteConfirm(KPI $kpi)
    {
        $this->delete_confirm = $kpi;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'KPI Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'aspiration', 'kpi_definition', 'kpi_id', 'update', 'link_id');
    }

    public function render()
    {
        $kpis = KPI::query()->with('priorityArea', 'target')->orderBy('id', 'DESC');

        if (($this->type == "International" or $this->type == "Regional") and $this->search_aspiration) {
            $kpis->where('target_id', $this->search_aspiration);
        } else {
            if ($this->search_aspiration == null) $this->search_aspiration = "";
            $kpis->where('priority_area_id', $this->search_aspiration);
        }
        $kpis->when($this->search_keyword, function ($query) {
            $query->where(function ($query) {
                $query->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%');
            });
        });

        $kpis = $kpis->paginate();

        return view('livewire.kpi-component', [
            'kpis' => $kpis,
            'priority_areas' => PriorityArea::all(),
        ])->layout('layouts.app');
    }
}
