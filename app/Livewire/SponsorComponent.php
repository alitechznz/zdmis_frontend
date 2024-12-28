<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class SponsorComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $org_name, $short_name, $country, $organization_category, $contact_person, $contact_details, $sponsor_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {

        $this->validate([
            'org_name' => 'required',
            'short_name' => 'required',
            'country' => 'required',
            'organization_category' => 'required',
            'contact_person' => 'required',
            'contact_details' => 'required|max:3000',
        ]);

        // dd($this->organization_category);



        Sponsor::updateOrCreate(['id' => $this->sponsor_id], [
            'org_name' => $this->org_name,
            'short_name' => $this->short_name,
            'country_id' => $this->country,
            'organization_category' => $this->organization_category,
            'contact_person' => $this->contact_person,
            'contact_details' => $this->contact_details,
        ]);


        $this->dispatch('swal:info', title: $this->sponsor_id ? 'Sponsor Updated.' : 'Sponsor Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($sponsor_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->sponsor_id = $sponsor_id;

        $sponsor = Sponsor::findOrFail($sponsor_id);
        $this->org_name = $sponsor->org_name;
        $this->short_name = $sponsor->short_name;
        $this->country = $sponsor->country_id;
        $this->organization_category = $sponsor->organization_category;
        $this->contact_person = $sponsor->contact_person;
        $this->contact_details = $sponsor->contact_details;
    }

    public function deleteConfirm(Sponsor $sponsor)
    {
        $this->delete_confirm = $sponsor;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Sponsor Deleted');
    }

    private function resetField()
    {
        $this->reset('org_name', 'short_name', 'country', 'organization_category', 'contact_person', 'contact_details', 'sponsor_id', 'update');
    }

    public function render()
    {
        $sponsors = Sponsor::query()->latest();
        if ($this->search_keyword) {
            $sponsors->where('id', $this->search_keyword)
                ->orWhere('org_name', 'like', '%' . $this->search_keyword . '%')->orWhere('short_name', 'like', '%' . $this->search_keyword . '%')->orWhere('country_id', 'like', '%' . $this->search_keyword . '%')->orWhere('organization_category', 'like', '%' . $this->search_keyword . '%')->orWhere('contact_person', 'like', '%' . $this->search_keyword . '%')->orWhere('contact_details', 'like', '%' . $this->search_keyword . '%');
        }

        $sponsors = $sponsors->paginate();


        return view('livewire.sponsor-component', [
            'sponsors' => $sponsors,
            'countries' => Country::all(),
        ])->layout('layouts.app');
    }
}
