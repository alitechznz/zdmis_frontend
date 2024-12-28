<?php

namespace App\Livewire;

use App\Models\SourceFinancing;
use Livewire\Component;
use Livewire\WithPagination;

class SourceFinancingComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $status, $category, $sourcefinancing_id = null;
    public $level = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required',
            'category' => 'required',
            'level' => 'required',
        ]);


        SourceFinancing::updateOrCreate(['id' => $this->sourcefinancing_id], [
            'name' => $this->name,
            'status' => $this->status,
            'category' => $this->category,
            'level' => $this->level,
        ]);

        $this->dispatch('swal:info', title: $this->sourcefinancing_id ? 'SourceFinancing Updated.' : 'SourceFinancing Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($sourcefinancing_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->sourcefinancing_id = $sourcefinancing_id;

        $sourcefinancing = SourceFinancing::findOrFail($sourcefinancing_id);
        $this->name = $sourcefinancing->name;
        $this->status = $sourcefinancing->status;
        $this->category = $sourcefinancing->category;
        $this->level = $sourcefinancing->level;
    }

    public function deleteConfirm(SourceFinancing $sourcefinancing)
    {
        $this->delete_confirm = $sourcefinancing;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Source Of Financing Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'status', 'category', 'sourcefinancing_id', 'level', 'update');
    }

    public function render()
    {
        $sourcefinancings = SourceFinancing::query()->latest();
        if ($this->search_keyword) {
            $sourcefinancings->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%');
        }

        $sourcefinancings = $sourcefinancings->paginate();


        return view('livewire.source-financing-component', [
            'sourcefinancings' => $sourcefinancings
        ])->layout('layouts.app');
    }
}
