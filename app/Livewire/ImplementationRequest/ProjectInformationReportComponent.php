<?php

namespace App\Livewire\ImplementationRequest;

use App\Models\ConceptNote;
use App\Models\FinanceParticular;
use App\Models\ProjectInformationReport;
use App\Models\ResourceTrackingReport;
use App\Models\SourceFinancing;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectInformationReportComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $project, $report_period, $project_report_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'project' => 'required',
            'report_period' => 'required',
        ]);
        ProjectInformationReport::updateOrCreate(['id' => $this->project_report_id], [
            'concept_note_project_id' => $this->project,
            'report_period' => $this->report_period,
        ]);

        $this->dispatch('swal:info', title: $this->project_report_id ? 'Project Information Updated.' : 'Project Information  Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($project_report_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->project_report_id = $project_report_id;

        $budgetterm = ProjectInformationReport::findOrFail($project_report_id);
        $this->project = $budgetterm->concept_note_project_id;
        $this->report_period = $budgetterm->report_period;
    }



    public function deleteConfirm(ProjectInformationReport $budgetterm)
    {
        $this->delete_confirm = $budgetterm;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Project Information  Deleted');
    }

    private function resetField()
    {
        $this->reset('project', 'report_period', 'project_report_id', 'update');
    }

    public function render()
    {
        $projectInformations = ProjectInformationReport::query()
            ->with(['conceptNote'])
            ->latest();

        if ($this->search_keyword) {
            // Adjust query to search within relationship fields
            $projectInformations->whereHas('conceptNote', function ($query) {
                $query->where('projectname', 'like', '%' . $this->search_keyword . '%');
            })->orWhere('report_period', 'like', '%' . $this->search_keyword . '%');
        }

        $projectInformations = $projectInformations->paginate();

        return view('livewire.implementation-request.project-information-report-component', [
            'projectInformations' => $projectInformations,
            'finance_particulars' => FinanceParticular::all(),
            'source_finances' => SourceFinancing::all(),
            'projects' => ConceptNote::where('type', 'proposal')->where('process_status', 6)->get(),
        ])->layout('layouts.app');
    }


}
