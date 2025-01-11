<?php

namespace App\Livewire;

use App\Models\Ministry;
use Livewire\Component;
use Livewire\WithPagination;

class MinistryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $short_name, $awamu, $type, $vote_number, $web_url, $phone, $email, $address, $ministry_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'short_name' => 'required',
            'phone' => 'required|digits:10|numeric',
            'email' => 'required|email',
            'address' => 'required|max:3000',
            'vote_number' => 'required',
        ]);
        Ministry::updateOrCreate(['id' => $this->ministry_id], [
            'name' => $this->name,
            'short_name' => $this->short_name,
            'awamu' => $this->awamu,
            'type' => "Government",
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'vote_number' => $this->vote_number,
            'web_url' => $this->web_url,
        ]);

        $this->dispatch('swal:info', title: $this->ministry_id ? 'Ministry Updated.' : 'Ministry Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($ministry_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->ministry_id = $ministry_id;

        $ministry = Ministry::findOrFail($ministry_id);
        $this->name = $ministry->name;
        $this->short_name = $ministry->short_name;
        $this->awamu = $ministry->awamu;
        $this->type = $ministry->type;
        $this->phone = $ministry->phone;
        $this->email = $ministry->email;
        $this->address = $ministry->address;
        $this->vote_number = $ministry->vote_number;
        $this->web_url = $ministry->web_url;
    }

    public function deleteConfirm(Ministry $ministry)
    {
        $this->delete_confirm = $ministry;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Ministry Deleted');
    }

    private function resetField()
    {
        $this->reset('name', 'short_name', 'web_url', 'awamu', 'vote_number', 'phone', 'email', 'address', 'ministry_id', 'update');
    }

    public function render()
    {
        $ministries = Ministry::query()->latest();
        if ($this->search_keyword) {
            $ministries->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('short_name', 'like', '%' . $this->search_keyword . '%')->orWhere('awamu', 'like', '%' . $this->search_keyword . '%')->orWhere('type', 'like', '%' . $this->search_keyword . '%')->orWhere('phone', 'like', '%' . $this->search_keyword . '%')->orWhere('email', 'like', '%' . $this->search_keyword . '%')->orWhere('address', 'like', '%' . $this->search_keyword . '%');
        }

        $ministries = $ministries->paginate();


        return view('livewire.ministry-component', [
            'ministries' => $ministries
        ])->layout('layouts.app');
    }
}
