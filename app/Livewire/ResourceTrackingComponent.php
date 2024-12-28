<?php

namespace App\Livewire;

use App\Models\FinanceParticular;
use App\Models\Project;
use App\Models\ResourceTracking;
use App\Models\SourceFinancing;
use Livewire\Component;
use Livewire\WithPagination;

class ResourceTrackingComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $finance_particular_id,  $finance_particular, $source_financing_id, $source_financing, $project_id, $project, $period, $currency, $currency_unit, $amount = "20,000,000,000", $resourcetracking_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'finance_particular' => 'required',
            'source_financing' => 'required',
            'project' => 'required',
            'period' => 'required',
            'currency_unit' => 'required',
            'amount' => 'required',
        ]);
        ResourceTracking::updateOrCreate(['id' => $this->resourcetracking_id], [
            'finance_particular_id' => $this->finance_particular,
            'source_financing_id' => $this->source_financing,
            'project_id' => $this->project,
            'period' => $this->period,
            'currency_unit' => $this->currency_unit,
            'amount' => $this->amount,
        ]);

        $this->dispatch('swal:info', title: $this->resourcetracking_id ? 'ResourceTracking Updated.' : 'ResourceTracking Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($resourcetracking_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->resourcetracking_id = $resourcetracking_id;

        $resourcetracking = ResourceTracking::findOrFail($resourcetracking_id);
        $this->finance_particular_id = $resourcetracking->finance_particular_id;
        $this->source_financing_id = $resourcetracking->source_financing_id;
        $this->project_id = $resourcetracking->project_id;
        $this->period = $resourcetracking->period;
        $this->currency_unit = $resourcetracking->currency_unit;
        $this->amount = $resourcetracking->amount;
    }

    public function deleteConfirm(ResourceTracking $resourcetracking)
    {
        $this->delete_confirm = $resourcetracking;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'ResourceTracking Deleted');
    }

    private function resetField()
    {
        $this->reset('finance_particular_id', 'source_financing_id', 'project_id', 'period', 'currency_unit', 'amount', 'resourcetracking_id', 'update');
    }

    public function render()
    {
        $resourcetrackings = ResourceTracking::query()->latest();
        if ($this->search_keyword) {
            $resourcetrackings->where('id', $this->search_keyword)
                ->orWhere('period', 'like', '%' . $this->search_keyword . '%')->orWhere('currency_unit', 'like', '%' . $this->search_keyword . '%');
        }

        $resourcetrackings = $resourcetrackings->paginate();
        $totalGovernmentAmount = 200000;
        $totalDonorAmount = 200000;
        $totalAmount = $totalGovernmentAmount + $totalDonorAmount;


        return view('livewire.resource-tracking-component', [
            'resourcetrackings' => $resourcetrackings,
            'finance_particulars' => FinanceParticular::all(),
            'source_finances' => SourceFinancing::all(),
            'projects' => Project::all(),
            'totalGovernmentAmount' => $totalGovernmentAmount,
            'totalDonorAmount' => $totalDonorAmount,
            'totalAmount' => $totalAmount
        ])->layout('layouts.app');
    }
}
