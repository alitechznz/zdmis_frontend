<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class UnitComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name,$code,$department, $unit_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'code' => 'required',
            'department' => 'required',
        ]);
        Unit::updateOrCreate(['id' => $this->unit_id],[
            'name' => $this->name,'code' => $this->code,'department_id' => $this->department,
        ]);

        $this->dispatch('swal:info', title: $this->unit_id ? 'Unit Updated.' : 'Unit Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($unit_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->unit_id = $unit_id;

        $unit = Unit::findOrFail($unit_id);
        $this->name = $unit->name;$this->code = $unit->code;$this->department = $unit->department_id;
    }

    public function deleteConfirm(Unit $unit){
        $this->delete_confirm = $unit;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Unit Deleted');
    }

    private function resetField(){
        $this->reset('name','code','department', 'unit_id' , 'update');
    }

    public function render()
    {
        $units = Unit::query()->with('department')->latest();
        if($this->search_keyword ){
            $units->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%'.$this->search_keyword.'%')->orWhere('code', 'like', '%'.$this->search_keyword.'%')->orWhere('department_id', 'like', '%'.$this->search_keyword.'%');
        }

        $units = $units->paginate();


        return view('livewire.unit-component', [
            'units' => $units,
            'departments' => Department::all(),
        ])->layout('layouts.app');
    }
}
