<?php

namespace App\Livewire\Proposal;

use App\Models\ConceptNoteLocation;
use App\Models\District;
use App\Models\Region;
use App\Models\Shehia;
use Livewire\Component;

class ProjectLocationComponent extends Component
{
    public $cn_project_location_list = [], $concept_note;
    public $selectedLocationLevel = "Shehia";
    public $location = "all";

    public $region_field, $district_field, $shehia_field, $selectedShehia, $selectedDistrict, $selectedRegion = null;
    public $districts = [], $shehias = [];
    public $concept_note_id, $type = null;
    public $is_step2 = true;

    protected $listeners = ['conceptNoteSaved' => 'updateConceptNoteId'];

    public function updateConceptNoteId($id)
    {
        $this->concept_note_id = $id;
    }
    public function mount($concept_note_id, $type)
    {
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;

        $this->cn_project_location_list = ConceptNoteLocation::where('concept_note_id', $this->concept_note_id)->get();
    }

    function selectedLocationLevel($location)
    {
        $this->selectedLocationLevel = $location;
        $this->location = $location;
    }

    public function updatedSelectedRegion($region_id)
    {
        if ($region_id) {
            $this->districts = District::where('region_id', $region_id)->get();
        }
    }
    public function updatedSelectedDistrict($district_id)
    {
        if ($district_id) {
            $this->shehias = Shehia::where('district_id', $district_id)->get();
        }
    }

    public function saveProjectLocation()
    {
        $this->validate([
            'selectedRegion' => 'required',
            'selectedShehia' => ($this->selectedLocationLevel == "Shehia") ? 'required' : 'nullable',
            'selectedDistrict' => ($this->selectedLocationLevel == "Region") ? 'nullable' : 'required',
        ]);

        $location_id = 0;
        $location_name = "";
        if ($this->selectedLocationLevel == "Region") {
            $region = Region::find($this->selectedRegion);
            $location_id = $region?->id;
            $location_name = $region?->name;
        } elseif ($this->selectedLocationLevel == "District") {
            $district = District::find($this->selectedDistrict);
            $location_id = $district?->id;
            $location_name = $district?->name;
        } elseif ($this->selectedLocationLevel == "Shehia") {
            $shehia = Shehia::find($this->selectedShehia);
            $location_id = $shehia?->id;
            $location_name = $shehia?->name;
        }

        ConceptNoteLocation::create([
            'location_name' => $location_name,
            'location_id' => $location_id,
            'location_level' => $this->selectedLocationLevel,
            'concept_note_id' => $this->concept_note_id
        ]);
        $this->is_step2 = true;
        $this->dispatch('isFinished', 'step 2');
        //fetch location list
        $this->cn_project_location_list = ConceptNoteLocation::where('concept_note_id', $this->concept_note_id)->get();
        $this->dispatch('swal:info', title: 'Location Saved');
    }

    public function deleteProjectLocation(ConceptNoteLocation $conceptNoteLocation)
    {
        $conceptNoteLocation->delete();
        $this->cn_project_location_list = ConceptNoteLocation::where('concept_note_id', $this->concept_note_id)->get();
        $this->dispatch('swal:info', title: 'Location Deleted');
    }

    public function render()
    {
        return view('livewire.proposal.project-location-component', [
            'districts' => District::where('region_id', $this->region_field)->get(),
            'regions' => Region::all(),
            'shehias' => Shehia::where('district_id', $this->district_field)->get(),
        ]);
    }
}
