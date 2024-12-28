<?php

namespace App\Livewire\Proposal;

use App\Models\ProjectProposalAttachment;
use Livewire\Component;

class ProjectAttachmentComponent extends Component
{
    public $project_proposal_attachments = [];
    public $proposal_attachment_name, $proposal_attachment_type, $proposal_attachment_file;
    public $concept_note_id, $type = null;
    protected $listeners = ['outputSaved' => 'updateOutput'];

    public function mount($concept_note_id, $type){
        $this->concept_note_id = $concept_note_id;
        $this->type = $type;

        $this->project_proposal_attachments = ProjectProposalAttachment::where('concept_note_id', $concept_note_id)->get();
    }

    public function updateOutput($outputs){
        $this->project_proposal_outputs = $outputs;
    }
    public function saveProjectProposalAttachment()
    {
        $this->validate([
            'proposal_attachment_name' => 'required|string|max:255',
            'proposal_attachment_type' => 'required|string',
            'proposal_attachment_file' => 'required|file|mimes:doc,docx,pdf',
        ]);
        $file_path = $this->proposal_attachment_file->store('proposal_attachments', 'public');
        ProjectProposalAttachment::create([
            'concept_note_id' => $this->concept_note_id,
            'attachment_name' => $this->proposal_attachment_name,
            'attachment_type' => $this->proposal_attachment_type,
            'file_path' => $file_path,
        ]);

        $this->dispatch('isFinished', 'step 8');
        $this->dispatch('swal:info', title: 'Attachment Saved Successfully!');
        $this->resetProposalAttachmentInputFields();
        $this->project_proposal_attachments = ProjectProposalAttachment::where('concept_note_id', $this->concept_note_id)->get();
    }

    public function deleteAttachment(ProjectProposalAttachment $attachment)
    {
        $attachment->delete();
        $this->dispatch('swal:info', title: 'Attachment Deleted Successfully!');
        $this->project_proposal_attachments = ProjectProposalAttachment::where('concept_note_id', $this->concept_note_id)->get();
    }

    private function resetProposalAttachmentInputFields()
    {
        $this->proposal_attachment_name = $this->proposal_attachment_type = $this->proposal_Attachment_file;
    }
    public function render()
    {
        return view('livewire.proposal.project-attachment-component');
    }
}
