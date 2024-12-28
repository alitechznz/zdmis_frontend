<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\ProjectProposal;
use App\Models\Sector;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $selected_plans, $project_proposal_id, $project_proposal, $sector, $project_name, $short_name, $sector_id, $start_date, $end_date, $description, $status, $project_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'selected_plans' => 'nullable',
            'project_proposal' => 'required',
            'project_name' => 'required',
            'short_name' => 'nullable',
            'sector' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
        Project::updateOrCreate(['id' => $this->project_id], [
            'selected_plans' => $this->selected_plans,
            'project_proposal_id' => $this->project_proposal,
            'project_name' => $this->project_name,
            'short_name' => $this->short_name,
            'sector_id' => $this->sector,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->project_id ? 'Project Updated.' : 'Project Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($project_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->project_id = $project_id;

        $project = Project::findOrFail($project_id);
        $this->selected_plans = $project->selected_plans;
        $this->project_proposal_id = $project->project_proposal_id;
        $this->project_name = $project->project_name;
        $this->short_name = $project->short_name;
        $this->sector_id = $project->sector_id;
        $this->start_date = $project->start_date;
        $this->end_date = $project->end_date;
        $this->description = $project->description;
        $this->status = $project->status;
    }

    public function deleteConfirm(Project $project)
    {
        $this->delete_confirm = $project;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Project Deleted');
    }

    private function resetField()
    {
        $this->reset('selected_plans', 'project_proposal_id', 'project_name', 'short_name', 'sector_id', 'start_date', 'end_date', 'description', 'status', 'project_id', 'update');
    }

    public function render()
    {
        $projects = Project::query()->latest();
        if ($this->search_keyword) {
            $projects->where('id', $this->search_keyword)
                ->orWhere('project_name', 'like', '%' . $this->search_keyword . '%')->orWhere('short_name', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $projects = $projects->paginate();


        return view('livewire.project-component', [
            'projects' => $projects,
            'sectors' => Sector::all(),
            'project_proposals' => ProjectProposal::all(),
        ])->layout('layouts.app');
    }
}
