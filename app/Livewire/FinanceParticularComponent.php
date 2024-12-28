<?php

namespace App\Livewire;

use App\Models\FinanceParticular;
use Livewire\Component;
use Livewire\WithPagination;

class FinanceParticularComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $status, $financeparticular_id = null;

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
        FinanceParticular::updateOrCreate(['id' => $this->financeparticular_id], [
            'name' => $this->name,
            'status' => $this->status,
        ]);


        $this->dispatch('swal:info', title: $this->financeparticular_id ? 'Finance Particular Updated.' : 'Finance Particular Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($financeparticular_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->financeparticular_id = $financeparticular_id;

        $financeparticular = FinanceParticular::findOrFail($financeparticular_id);
        $this->name = $financeparticular->name;
        $this->status = $financeparticular->status;
    }

    public function deleteConfirm(FinanceParticular $financeparticular)
    {
        $this->delete_confirm = $financeparticular;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Finance Particular Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'status', 'financeparticular_id', 'update');
    }

    public function render()
    {
        $financeparticulars = FinanceParticular::query()->latest();
        if ($this->search_keyword) {
            $financeparticulars->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $financeparticulars = $financeparticulars->paginate();


        return view('livewire.finance-particular-component', [
            'financeparticulars' => $financeparticulars
        ])->layout('layouts.app');
    }
}
