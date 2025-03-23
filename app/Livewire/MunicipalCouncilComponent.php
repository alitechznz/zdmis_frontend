<?php

namespace App\Livewire;

use App\Models\MunicipalCouncil;
use App\Models\RegionalAuthority;
use Livewire\Component;
use Livewire\WithPagination;

class MunicipalCouncilComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $regional_authority, $status, $municipal_council_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'regional_authority' => 'required',
            'status' => 'required',
        ]);
        MunicipalCouncil::updateOrCreate(['id' => $this->municipal_council_id], [
            'name' => $this->name,
            'regional_authority_id' => $this->regional_authority,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->municipal_council_id ? 'Municipal Council Updated.' : 'Municipal Council Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($municipal_council_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->municipal_council_id = $municipal_council_id;

        $municipal_council = MunicipalCouncil::findOrFail($municipal_council_id);
        $this->name = $municipal_council->name;
        $this->regional_authority = $municipal_council->regional_authority;
        $this->status = $municipal_council->status;
    }

    public function deleteConfirm(MunicipalCouncil $municipal_council)
    {
        $this->delete_confirm = $municipal_council;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Municipal Council Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'regional_authority', 'status', 'municipal_council_id', 'update');
    }

    public function render()
    {
        // $municipal_councils = MunicipalCouncil::query()->with(['regionalAuthority'])->latest();
        // if ($this->search_keyword) {
        //     $municipal_councils->where('id', $this->search_keyword)
        //         ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('regional_authority_id', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        // }

        // $municipal_councils = $municipal_councils->paginate();


        return view('livewire.municipal-council-component', [
            // 'municipal_councils' => $municipal_councils,
            // 'regional_authorities' => RegionalAuthority::all(),
        ])->layout('layouts.app');
    }
}
