<?php

namespace App\Livewire;

use App\Models\ConceptNote;
use App\Models\FinanceParticular;
use App\Models\ProjectInformationReport;
use App\Models\SourceFinancing;
use Livewire\Component;
use Livewire\WithPagination;

class AddResourceTrackingComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $project, $report_period, $project_report_id = null;

    public function render()
    {
        $projectInformations = ProjectInformationReport::query()->latest();
        if ($this->search_keyword) {
            $projectInformations->where('id', $this->search_keyword)
                ->orWhere('project', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $projectInformations = $projectInformations->paginate();


        return view('livewire.add-resource-tracking-component', [
            'projectInformations' => $projectInformations,
            'finance_particulars' => FinanceParticular::all(),
            'source_finances' => SourceFinancing::all(),
            'projects' => ConceptNote::where('type', 'proposal')->where('process_status', 6)->get(),
        ])->layout('layouts.app');
    }
}
