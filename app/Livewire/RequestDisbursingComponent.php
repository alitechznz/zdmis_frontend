<?php

namespace App\Livewire;

use App\Models\ConceptNote;
use App\Models\ProjectProposalActivity;
use App\Models\ProjectProposalOutcome;
use App\Models\ProjectProposalOutput;
use App\Models\RequestImplementation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RequestDisbursingComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $project_title, $file_type, $attachment, $requested_status, $requested_id, $project_name, $implementation_request_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'project_name' => 'required',
            'file_type' => 'required',
            //            'attachment' => 'required|nullable|file|mimes:pdf,doc,docx|max:10240',
            //            'attachment' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($this->attachment) {
            // Generate a unique file name with the attachment title and a timestamp
            $filename = $this->file_type . '_' . time() . '.' . $this->attachment->getClientOriginalExtension();

            // Store the file in the 'public' disk under 'financing_agreement_docs' directory with the custom filename
            $filePath = $this->attachment->storeAs('ImplementationRequestDocs', $filename, 'public');

            RequestImplementation::updateOrCreate(['id' => $this->implementation_request_id], [
                'project_id' => $this->project_name,
                'file_type' => $this->file_type,
                'attachment' => $filePath,
            ]);

            $this->dispatch('swal:info', title: $this->implementation_request_id ? 'Request Updated.' : 'Request Created');

            $this->resetField();
            $this->update = false;

            //close modal
            $this->dispatch('closeModal');
        }
    }


    public function edit($implementation_request_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->implementation_request_id = $implementation_request_id;

        $requestImplementation = RequestImplementation::findOrFail($implementation_request_id);
        $this->file_type = $requestImplementation->file_type;
        $this->attachment = $requestImplementation->attachment;
    }



    public function downloadAttachment($id)
    {
        $requestImplementation = RequestImplementation::findOrFail($id);

        // Construct the full path to the file
        $filePath = storage_path('app/public/' . $requestImplementation->attachment);

        // Check if file exists in the filesystem
        if ($requestImplementation && file_exists($filePath)) {
            // Return the file as a download
            return response()->download($filePath);
        } else {
            // If file does not exist, return an error response
            return response()->json(['error' => 'File does not exist.'], 404);
        }
    }



    public function deleteConfirm(RequestImplementation $requestImplementation)
    {
        $this->delete_confirm = $requestImplementation;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Request Implementation  Deleted');
    }

    private function resetField()
    {
        $this->reset('project_title', 'file_type', 'attachment', 'requested_status', 'requested_id', 'update');
        $this->update = false;
    }



    public function render()
    {
        $requestImplementations = RequestImplementation::query()->latest();
        if ($this->search_keyword) {
            $requestImplementations->where('id', $this->search_keyword)
                ->orWhere('project_title', 'like', '%' . $this->search_keyword . '%')->orWhere('requested_status', 'like', '%' . $this->search_keyword . '%');
        }

        $requestImplementations = $requestImplementations->paginate();
        return view('livewire.request-disbursing-component', [
            'requestImplementations' => $requestImplementations,
            'projects' => ConceptNote::where('type', 'Proposal')->where('process_status', 6)->get(),
            'outcomes' => ProjectProposalOutcome::all(),
            'outputs' => ProjectProposalOutput::all(),
            'activities' => ProjectProposalActivity::all(),
        ])->layout('layouts.app');
    }
}
