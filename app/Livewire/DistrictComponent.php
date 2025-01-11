<?php

namespace App\Livewire;

use App\Models\District;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class DistrictComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name,$region,$status, $district_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required','region' => 'required','status' => 'required',
        ]);
        District::updateOrCreate(['id' => $this->district_id],[
            'name' => $this->name,'region_id' => $this->region,'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->district_id ? 'District Updated.' : 'District Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($district_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->district_id = $district_id;

        $district = District::findOrFail($district_id);
        $this->name = $district->name;$this->region = $district->region_id;$this->status = $district->status;
    }

    public function deleteConfirm(District $district){
        $this->delete_confirm = $district;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'District Deleted');
    }

    private function resetField(){
        $this->reset('name','region','status', 'district_id' , 'update');
    }

    public function render()
    {
        $districts = District::query()->with('region')->latest();
        if($this->search_keyword ){
            $districts->where('id', $this->search_keyword)
                ->orWhere('name', 'like', '%'.$this->search_keyword.'%')->orWhere('region_id', 'like', '%'.$this->search_keyword.'%')->orWhere('status', 'like', '%'.$this->search_keyword.'%');
        }

        $districts = $districts->paginate();


        return view('livewire.district-component', [
            'districts' => $districts,
            'regions' => Region::all(),
        ])->layout('layouts.app');
    }
}
