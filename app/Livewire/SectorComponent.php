<?php

namespace App\Livewire;

use App\Models\Ministry;
use App\Models\Sector;
use Livewire\Component;
use Livewire\WithPagination;

class SectorComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $ministry, $status, $sector_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'ministry' => 'required',
            'status' => 'required',
        ]);
        Sector::updateOrCreate(['id' => $this->sector_id], [
            'name' => $this->name,
            'ministry_id' => $this->ministry,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->sector_id ? 'Sector Updated.' : 'Sector Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($sector_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->sector_id = $sector_id;

        $sector = Sector::findOrFail($sector_id);
        $this->name = $sector->name;
        $this->ministry = $sector->ministry_id;
        $this->status = $sector->status;
    }

    public function deleteConfirm(Sector $sector)
    {
        $this->delete_confirm = $sector;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Sector Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'ministry', 'status', 'sector_id', 'update');
    }

    public function render()
    {
        $sectors = Sector::query()->with('responsibleUser')->latest();
        if ($this->search_keyword) {
            $sectors->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $sectors = $sectors->paginate();


        return view('livewire.sector-component', [
            'sectors' => $sectors,
            'ministries' => Ministry::all(),
        ])->layout('layouts.app');
    }
}
