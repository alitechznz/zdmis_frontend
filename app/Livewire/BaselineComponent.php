<?php

namespace App\Livewire;

use App\Models\Baseline;
use App\Models\KPI;
use App\Models\Unit;
use App\Models\UnitValue;
use Livewire\Component;
use Livewire\WithPagination;

class BaselineComponent extends Component
{
    use WithPagination;

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm, $search_kpi = null;
    public $name, $kpi, $indicators, $category, $unit, $link_id, $value, $year, $baseline_id = null;
    protected $paginationTheme = 'bootstrap';
    public $links = [];
    public function mount($type = null, $category = null)
    {
        $this->indicators = KPI::where('category', $category)->get();
        $this->category = $category;
        //        if ($this->category == "middle term"){
        //            $this->links = Baseline::where('category', 'long term')->get();
        //        } else if ($this->category == "short term"){
        //            $this->links = Baseline::where('category', 'middle term')->get();
        //        }
    }
    public function fetchFilter()
    {
        $this->indicators = KPI::where('category', $this->category)->orderBy('name', 'asc')->get();
    }
    public function create()
    {
        $this->resetField();
        if ($this->search_kpi) {
            $this->kpi = $this->search_kpi;
        }
    }

    private function resetField()
    {
        $this->reset('name', 'kpi', 'unit', 'value', 'year', 'link_id', 'baseline_id', 'update');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:240',
            //            'link_id' => ($this->category == "long term") ? 'nullable' : 'required',
            'unit' => 'required',
            'value' => 'required|string|max:100',
            'year' => 'required|digits:4|integer|min:1900',
        ]);
        $this->kpi = $this->search_kpi;
        Baseline::updateOrCreate(['id' => $this->baseline_id], [
            'name' => $this->name,
            'kpi_id' => $this->kpi,
            'unit_id' => $this->unit,
            'category' => $this->category,
            'value' => $this->value,
            'year' => $this->year,
            'link_id' => $this->link_id,
        ]);

        $this->dispatch('swal:info', title: $this->baseline_id ? 'Baseline Updated.' : 'Baseline Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($baseline_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->baseline_id = $baseline_id;

        $baseline = Baseline::findOrFail($baseline_id);
        $this->name = $baseline->name;
        $this->kpi = $baseline->kpi_id;
        $this->unit = $baseline->unit_id;
        $this->value = $baseline->value;
        $this->year = $baseline->year;
    }

    public function deleteConfirm(Baseline $baseline)
    {
        $this->delete_confirm = $baseline;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Baseline Deleted');
    }

    public function render()
    {
        $baselines = Baseline::query()->with('unitValue')
            ->orderBy('id', 'desc')
            ->where('category', $this->category)
            ->where('kpi_id', $this->search_kpi)
            ->when($this->search_keyword, function ($query){
                $query->where(function ($query){
                    $query->where('id', $this->search_keyword)
                    ->orWhere('name', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('unit_id', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('value', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('year', 'like', '%' . $this->search_keyword . '%');
                });
            })->paginate();


        return view('livewire.baseline-component', [
            'baselines' => $baselines,
            'units' => UnitValue::all(),
        ])->layout('layouts.app');
    }
}
