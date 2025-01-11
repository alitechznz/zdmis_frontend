<?php

namespace App\Livewire\ImplementationRequest;


use App\Models\ConceptNote;
use App\Models\FinanceParticular;
use App\Models\ProjectInformationReport;
use App\Models\ResourceTrackingReport;
use App\Models\SourceFinancing;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ResourceTrackingComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $finance_particular, $attachment, $source_financing, $amount, $report_period, $resource_tracking_id;

    public function mount()
    {
        $this->finance_particular = "Actual Expenditure";
    }

    public function create()
    {
        $this->resetField();
    }


    public function store()
    {
        $this->validate([
            'finance_particular' => 'required',
            'source_financing' => 'required',
            'report_period' => 'required',
            'amount' => 'required',
            'attachment' => 'nullable|file|mimes:pdf,docx|max:2048',
        ]);

        $data = [
            'finance_particular' => 'Actual Expenditure',
            'source_finance_id' => $this->source_financing,
            'report_period' => $this->report_period,
            // Remove commas before converting to a numeric value for storage
            'amount' => str_replace(',', '', $this->amount),
        ];

        if ($this->attachment) {
            $filename = $this->attachment->getClientOriginalName();
            $filePath = $this->attachment->storeAs('ResourceTracking', $filename, 'public');
            $data['attachment'] = $filePath;
        }

        // Update or create the resource tracking record
        ResourceTrackingReport::updateOrCreate(['id' => $this->resource_tracking_id], $data);



        $this->dispatch('swal:info', title: $this->resource_tracking_id ? 'Resource Tracking Updated.' : 'Resource Tracking  Created');

        $this->resetField();

        // Close modal
        $this->dispatch('closeModal');
    }


    public function edit($resource_tracking_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->resource_tracking_id = $resource_tracking_id;

        $resourceTracking = ResourceTrackingReport::findOrFail($resource_tracking_id);
        $this->source_financing = $resourceTracking->source_finance_id;
        $this->finance_particular = $resourceTracking->finance_particular;
        $this->report_period = $resourceTracking->report_period;
        $this->amount = $resourceTracking->amount;
    }


    private function resetField()
    {
        $this->reset('finance_particular', 'source_financing', 'report_period', 'amount', 'attachment', 'resource_tracking_id', 'update');
    }


    public function deleteConfirm(ResourceTrackingReport $resourceTracking)
    {
        $this->delete_confirm = $resourceTracking;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Resource Tracking Deleted');
    }

    public function downloadAttachment($id)
    {
        $resourceTracking = ResourceTrackingReport::findOrFail($id);

        // Construct the full path to the file
        $filePath = storage_path('app/public/' . $resourceTracking->attachment);

        // Check if file exists in the filesystem
        if ($resourceTracking && file_exists($filePath)) {
            // Return the file as a download
            return response()->download($filePath);
        } else {
            // If file does not exist, return an error response
            return response()->json(['error' => 'File does not exist.'], 404);
        }
    }



    public function render()
    {
        $resourceTrackings = ResourceTrackingReport::query()
            ->with(['projectInformationReport', 'sourceFinance'])
            ->latest();

        if ($this->search_keyword) {
            // Adjust query to search within relationship fields
            $resourceTrackings->whereHas('projectInformationReport', function ($query) {
                $query->where('report_period', 'like', '%' . $this->search_keyword . '%');
            })
                ->orWhereHas('sourceFinance', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_keyword . '%');
                });
        }

        $resourceTrackings = $resourceTrackings->paginate();

        return view('livewire.implementation-request.resource-tracking-component', [
            'resourceTrackings' => $resourceTrackings,
            'source_finances' => SourceFinancing::all(),
            'projectInfomationReports' => ProjectInformationReport::all(),
            'finance_particulars' => FinanceParticular::all(),
            'projects' => ConceptNote::where('type', 'proposal')->where('process_status', 6)->get(),
        ])->layout('layouts.app');
    }
}