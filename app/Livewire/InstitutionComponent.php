<?php

namespace App\Livewire;

use App\Models\Institution;
use App\Models\Ministry;
use Livewire\Component;
use Livewire\WithPagination;

class InstitutionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $ministry, $address, $vote_number, $web_url, $institution_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'ministry' => 'required',
            'address' => 'required|max:3000',
            'vote_number' => 'required',
        ]);
        Institution::updateOrCreate(['id' => $this->institution_id], [
            'name' => $this->name,
            'ministry_id' => $this->ministry,
            'address' => $this->address,
            'vote_number' => $this->vote_number,
            'web_url' => $this->web_url,
        ]);

        $this->dispatch('swal:info', title: $this->institution_id ? 'Institution Updated.' : 'Institution Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($institution_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->institution_id = $institution_id;

        $institution = Institution::findOrFail($institution_id);
        $this->name = $institution->name;
        $this->ministry = $institution->ministry_id;
        $this->address = $institution->address;
        $this->vote_number = $institution->vote_number;
        $this->web_url = $institution->web_url;
    }

    public function deleteConfirm(Institution $institution)
    {
        $this->delete_confirm = $institution;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Institution Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'ministry', 'web_url', 'vote_number', 'address', 'institution_id', 'update');
    }

    public function render()
    {
        // $institutions = Institution::query()->latest();
        // if ($this->search_keyword) {
        //     $institutions->where('id', $this->search_keyword)
        //         ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('ministry_id', 'like', '%' . $this->search_keyword . '%')->orWhere('address', 'like', '%' . $this->search_keyword . '%');
        // }

        // $institutions = $institutions->paginate();


        return view('livewire.institution-component', [
            // 'institutions' => $institutions,
            // 'ministries' => Ministry::all(),
        ])->layout('layouts.app');
    }
}
