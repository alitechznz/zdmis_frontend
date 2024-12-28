<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class RegionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $status, $region_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        Region::updateOrCreate(['id' => $this->region_id], [
            'name' => $this->name,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->region_id ? 'Region Updated.' : 'Region Created');
        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($region_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->region_id = $region_id;

        $region = Region::findOrFail($region_id);
        $this->name = $region->name;
        $this->status = $region->status;
    }

    public function deleteConfirm(Region $region)
    {
        $this->delete_confirm = $region;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Region Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'status', 'region_id', 'update');
    }

    public function render()
    {
        $regions = Region::query()->latest();
        if ($this->search_keyword) {
            $regions->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $regions = $regions->paginate();


        return view('livewire.region-component', [
            'regions' => $regions
        ])->layout('layouts.app');
    }
}
