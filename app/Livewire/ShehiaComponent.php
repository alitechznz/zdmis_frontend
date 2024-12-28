<?php

namespace App\Livewire;

use App\Models\District;
use App\Models\Shehia;
use Livewire\Component;
use Livewire\WithPagination;

class ShehiaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $district, $status, $shehia_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'district' => 'required',
            'status' => 'required',
        ]);
        Shehia::updateOrCreate(['id' => $this->shehia_id], [
            'name' => $this->name,
            'district_id' => $this->district,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->shehia_id ? 'Shehia Updated.' : 'Shehia Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($shehia_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->shehia_id = $shehia_id;

        $shehia = Shehia::findOrFail($shehia_id);
        $this->name = $shehia->name;
        $this->district = $shehia->district_id;
        $this->status = $shehia->status;
    }

    public function deleteConfirm(Shehia $shehia)
    {
        $this->delete_confirm = $shehia;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Shehia Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'district', 'status', 'shehia_id', 'update');
    }

    public function render()
    {
        $shehias = Shehia::query()->latest();
        if ($this->search_keyword) {
            $shehias->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('district_id', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $shehias = $shehias->paginate();


        return view('livewire.shehia-component', [
            'shehias' => $shehias,
            'districts' => District::all(),
        ])->layout('layouts.app');
    }
}