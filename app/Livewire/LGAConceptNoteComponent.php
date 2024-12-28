<?php

namespace App\Livewire;

use App\Models\AddlgaApproveList;
use App\Models\ConceptNote;
use App\Models\Sector;
use App\Models\SourceFinancing;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class LGAConceptNoteComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $characterCount = 0;

    public $selected_plans, $projectname, $shortname, $sector, $startdate, $enddate,  $process_status, $project_code, $description, $project_gfs_code, $contribution_sector, $organization_name, $responsible_user, $class, $type, $lga_concept_note_id = null;




    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'selected_plans' => 'string|nullable',
            'projectname' => 'string|nullable',
            'shortname' => 'string|nullable',
            'class' => 'nullable',
            'startdate' => 'nullable',
            'enddate' => 'nullable',
            'type' => 'string|nullable',
        ]);

        ConceptNote::updateOrCreate(['id' => $this->lga_concept_note_id], [
            'selected_plans' => $this->selected_plans,
            'projectname' => $this->projectname,
            'shortname' => $this->shortname,
            'sector_id' => $this->sector,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'process_status' => $this->process_status,
            'project_code' => $this->project_code,
            'description' => $this->description,
            'project_gfs_code' => $this->project_gfs_code,
            'contribution_sector' => $this->contribution_sector,
            'organization_name' => $this->organization_name,
            'responsible_user' => $this->responsible_user,
            'class' => $this->class,
            'type' => 'lga',
        ]);

        $this->dispatch('swal:info', title: $this->lga_concept_note_id ? 'LGA Concept Note Updated.' : 'LGA Concept Note Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($lga_concept_note_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->lga_concept_note_id = $lga_concept_note_id;

        $lgaConceptNote = ConceptNote::findOrFail($lga_concept_note_id);
        $this->selected_plans = $lgaConceptNote->selected_plans;
        $this->projectname = $lgaConceptNote->projectname;
        $this->shortname = $lgaConceptNote->shortname;
        $this->sector_id = $lgaConceptNote->sector;
        $this->startdate = $lgaConceptNote->startdate;
        $this->enddate = $lgaConceptNote->enddate;
        $this->process_status = $lgaConceptNote->process_status;
        $this->project_code = $lgaConceptNote->project_code;
        $this->description = $lgaConceptNote->description;
        $this->project_gfs_code = $lgaConceptNote->project_gfs_code;
        $this->contribution_sector = $lgaConceptNote->contribution_sector;
        $this->organization_name = $lgaConceptNote->organization_name;
        $this->responsible_user = $lgaConceptNote->responsible_user;
        $this->type = $lgaConceptNote->type;
        $this->class = $lgaConceptNote->class;
    }

    public function deleteConfirm(ConceptNote $lga_approve)
    {
        $this->delete_confirm = $lga_approve;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'LGA Concept Note  Deleted');
    }

    private function resetField()
    {
        $this->reset('selected_plans', 'projectname', 'shortname', 'sector', 'lga_concept_note_id', 'update', 'startdate', 'enddate', 'project_code');
    }




    public function render()
    {
        $all_data = ConceptNote::query()->where('type', 'lga')->latest();
        if ($this->search_keyword) {
            $all_data->where('id', $this->search_keyword)
                ->orWhere('title', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $all_data = $all_data->paginate();
        return view('livewire.lga-concept-note-component', [
            'all_data' => $all_data,
            'conceptNote' => ConceptNote::all(),
            'sourceFinancings' => SourceFinancing::all(),
            'sectors' => Sector::where('status', 'active')->get(),
        ])->layout('layouts.app');
    }

}
