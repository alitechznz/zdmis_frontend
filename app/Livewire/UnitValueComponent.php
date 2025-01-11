<?php

namespace App\Livewire;

use App\Models\UnitValue;
use Livewire\Component;
use Livewire\WithPagination;

class UnitValueComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $unit_name, $unit_symbol, $unit_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'unit_name' => 'required',
            'unit_symbol' => 'required',
        ]);
        UnitValue::updateOrCreate(['id' => $this->unit_id], [
            'unit_name' => $this->unit_name,
            'unit_symbol' => $this->unit_symbol,
        ]);

        $this->dispatch('swal:info', title: $this->unit_id ? 'Unit Value Updated.' : 'Unit Value Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($unit_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->unit_id = $unit_id;

        $unitValue = UnitValue::findOrFail($unit_id);
        $this->unit_name = $unitValue->unit_name;
        $this->unit_symbol = $unitValue->unit_symbol;
    }

    public function deleteConfirm(UnitValue $unitValue)
    {
        $this->delete_confirm = $unitValue;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Unit Value Deleted');
    }

    private function resetField()
    {
        $this->reset('unit_name', 'unit_symbol', 'update');
    }

    public function render()
    {
        $unitValues = UnitValue::query()->latest();
        if ($this->search_keyword) {
            $unitValues->where('id', $this->search_keyword)
                ->orWhere('unit_name', 'like', '%' . $this->search_keyword . '%')->orWhere('unit_symbol', 'like', '%' . $this->search_keyword . '%')->orWhere('unit_name', 'like', '%' . $this->search_keyword . '%')->orWhere('unit_name', 'like', '%' . $this->search_keyword . '%')->orWhere('unit_name', 'like', '%' . $this->search_keyword . '%');
        }

        $unitValues = $unitValues->paginate();


        return view('livewire.unit-value-component', [
            'unitValues' => $unitValues,
        ])->layout('layouts.app');
    }
}
