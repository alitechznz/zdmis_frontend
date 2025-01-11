<?php

namespace App\Livewire;

use App\Models\MunicipalCouncil;
use App\Models\Shehia;
use App\Models\ShehiaCommittee;
use Livewire\Component;
use Livewire\WithPagination;

class ShehiaCommitteeComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $contact_person, $municipal_council, $shehia, $contact_detail, $status, $shehia_committee_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'contact_person' => 'required',
            'municipal_council' => 'required',
            'shehia' => 'required',
            'contact_detail' => 'required',
            'status' => 'required',
        ]);
        ShehiaCommittee::updateOrCreate(['id' => $this->shehia_committee_id], [
            'contact_person' => $this->contact_person,
            'municipal_council_id' => $this->municipal_council,
            'shehia_id' => $this->shehia,
            'contact_detail' => $this->contact_detail,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->shehia_committee_id ? 'Shehia Committee Updated.' : 'Shehia Committee Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($shehia_committee_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->shehia_committee_id = $shehia_committee_id;

        $shehia_committee = ShehiaCommittee::findOrFail($shehia_committee_id);
        $this->contact_person = $shehia_committee->contact_person;
        $this->municipal_council = $shehia_committee->municipal_council_id;
        $this->shehia = $shehia_committee->shehia_id;
        $this->contact_detail = $shehia_committee->contact_detail;
        $this->status = $shehia_committee->status;
    }

    public function deleteConfirm(ShehiaCommittee $shehia_committee)
    {
        $this->delete_confirm = $shehia_committee;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Shehia Committee Deleted');
    }

    private function resetField()
    {
        $this->reset('contact_person', 'municipal_council', 'shehia', 'contact_detail', 'status', 'shehia_committee_id', 'update');
    }

    public function render()
    {
        $shehia_committees = ShehiaCommittee::query()->with(['municipalCouncil', 'shehia'])->latest();
        if ($this->search_keyword) {
            $shehia_committees->where('id', $this->search_keyword)
                ->orWhere('contact_person', 'like', '%' . $this->search_keyword . '%')->orWhere('municipal_council_id', 'like', '%' . $this->search_keyword . '%')->orWhere('shehia_id', 'like', '%' . $this->search_keyword . '%')->orWhere('contact_detail', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $shehia_committees = $shehia_committees->paginate();


        return view('livewire.shehia-committee-component', [
            'shehia_committees' => $shehia_committees,
            'municipal_councils' => MunicipalCouncil::all(),
            'shehias' => Shehia::all(),
        ])->layout('layouts.app');
    }
}
