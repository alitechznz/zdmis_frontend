<?php

namespace App\Livewire;

use App\Models\ConceptNote;
use App\Models\ProjectProposalActivity;
use App\Models\ProjectProposalOutcome;
use App\Models\ProjectProposalOutput;
use App\Models\RequestExtension;
use Livewire\Component;

class ManageExtensionComponent extends Component
{
    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $selectedRequest = null;

    public function loadRequestDetails($requestId)
    {
        $this->selectedRequest = RequestExtension::with(['conceptNote', 'outcome', 'output', 'proposalActivity'])
            ->findOrFail($requestId);
        // $this->dispatch('showModal'); // Trigger modal display
    }

    public function render()
    {
        $requestExtensions = RequestExtension::query()
            ->with(['conceptNote', 'proposalActivity'])
            ->latest();

        if ($this->search_keyword) {
            // Adjust query to search within relationship fields
            $requestExtensions->whereHas('conceptNote', function ($query) {
                $query->where('projectname', 'like', '%' . $this->search_keyword . '%');
            })
                ->orWhereHas('output', function ($query) {
                    $query->where('reporting_period', 'like', '%' . $this->search_keyword . '%');
                });
        }

        $requestExtensions = $requestExtensions->paginate();

        return view('livewire.manage-extension-component', [
            'requestExtensions' => $requestExtensions,
            'projects' => ConceptNote::where('type', 'proposal')->where('process_status', 6)->get(),
            'outcomes' => ProjectProposalOutcome::all(),
            'outputs' => ProjectProposalOutput::all(),
            'activities' => ProjectProposalActivity::all(),
        ])->layout('layouts.app');
    }
}
