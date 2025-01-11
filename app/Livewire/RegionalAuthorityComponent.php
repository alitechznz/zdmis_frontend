<?php

namespace App\Livewire;

use App\Models\Region;
use App\Models\RegionalAuthority;
use Livewire\Component;
use Livewire\WithPagination;

class RegionalAuthorityComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $region, $type, $regional_authority_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'region' => 'required',
        ]);
        RegionalAuthority::updateOrCreate(['id' => $this->regional_authority_id], [
            'name' => $this->name,
            'region_id' => $this->region,
        ]);

        $this->dispatch('swal:info', title: $this->regional_authority_id ? 'Regional Authority Updated.' : 'Regional Authority Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($regional_authority_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->regional_authority_id = $regional_authority_id;

        $regional_authority = RegionalAuthority::findOrFail($regional_authority_id);
        $this->name = $regional_authority->name;
        $this->region = $regional_authority->region_id;
    }

    public function deleteConfirm(RegionalAuthority $regional_authority)
    {
        $this->delete_confirm = $regional_authority;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Regional Authority Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'region', 'regional_authority_id', 'update');
    }

    public function render()
    {
        $regional_authorities = RegionalAuthority::query()->with('region')->latest();
        if ($this->search_keyword) {
            $regional_authorities->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('region_id', 'like', '%' . $this->search_keyword . '%')->orWhere('type', 'like', '%' . $this->search_keyword . '%');
        }

        $regional_authorities = $regional_authorities->paginate();


        return view('livewire.regional-authority-component', [
            'regional_authorities' => $regional_authorities,
            'regions' => Region::all(),
        ])->layout('layouts.app');
    }
}
