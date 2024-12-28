<?php

namespace App\Livewire;

use App\Models\AddDisbursementSchedule;
use App\Models\AddFinancingAgreement;
use App\Models\AddFinancingAgreementDocument;
use App\Models\ConceptNote;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


class AddFinancingAgreementComponent extends Component
{


    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $total_funding_amount, $financing_agreement_dis, $milestone_type, $condition, $installment_type, $disburse_id, $amount, $schedule_date, $conceptNoteId, $conceptNote, $agreement_reference, $termination_clause, $funding_agency, $interest_rate, $agreement_title, $attachment_title, $financing_agreement_id, $financing_agreement, $attachment, $currency, $repayment_terms, $terms_agreement_start_date, $finance_id, $finance_doc_id, $concept_note, $terms_agreement_end_date, $conditions_precedent = null;

    public function create()
    {
        $this->resetField();
    }

    public function mount($conceptNoteId = null)
    {
        if ($conceptNoteId) {
            $this->loadConceptNoteData($conceptNoteId);
        }
    }

    public function loadConceptNoteData($conceptNoteId)
    {
        $conceptNote = ConceptNote::find($conceptNoteId);
        if (!$conceptNote) {
            session()->flash('error', 'The specified concept note was not found.');
            return;
        }
        $this->conceptNote = $conceptNote->projectname;
        $this->conceptNoteId = $conceptNote->id;
    }



    public function store()
    {
        $this->validate([
            'conceptNoteId' => 'required',
            'agreement_title' => 'required',
            'agreement_reference' => 'required',
            'funding_agency' => 'required',
            'total_funding_amount' => 'required|string',  // Make sure to accept the formatted string
            'currency' => 'required',
            'terms_agreement_start_date' => 'required|date',
            'terms_agreement_end_date' => 'required|date',
            'conditions_precedent' => 'required|max:3000',
            'repayment_terms' => 'required|max:3000',
            'interest_rate' => 'required|numeric',
            'termination_clause' => 'required|max:3000',
        ]);

        // Remove commas for the numeric conversion if there are any
        $formattedAmount = str_replace(',', '', $this->total_funding_amount);
        // Optionally, convert to a number to ensure it's stored as numeric in the database
        $formattedAmount = (float) $formattedAmount;

        AddFinancingAgreement::updateOrCreate(['id' => $this->finance_id], [
            'concept_note_id' => $this->conceptNoteId,
            'agreement_title' => $this->agreement_title,
            'agreement_reference' => $this->agreement_reference,
            'funding_agency' => $this->funding_agency,
            'total_funding_amount' => $formattedAmount,  // Save the formatted amount
            'currency' => $this->currency,
            'terms_agreement_start_date' => $this->terms_agreement_start_date,
            'terms_agreement_end_date' => $this->terms_agreement_end_date,
            'conditions_precedent' => $this->conditions_precedent,
            'repayment_terms' => $this->repayment_terms,
            'interest_rate' => $this->interest_rate,
            'termination_clause' => $this->termination_clause,
        ]);

        $this->dispatch('swal:info', title: $this->finance_id ? 'Financing Agreement Updated.' : 'Financing Agreement Created');

        $this->resetField();
        $this->update = false;
        // Close modal
        $this->dispatch('closeModal');
    }


    public function edit($finance_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->finance_id = $finance_id;

        $financingAgreement = AddFinancingAgreement::findOrFail($finance_id);
        $this->concept_note = $financingAgreement->concept_note_id;
        $this->agreement_title = $financingAgreement->agreement_title;
        $this->agreement_reference = $financingAgreement->agreement_reference;
        $this->funding_agency = $financingAgreement->funding_agency;
        $this->total_funding_amount = $financingAgreement->total_funding_amount;
        $this->currency = $financingAgreement->currency;
        $this->terms_agreement_start_date = $financingAgreement->terms_agreement_start_date;
        $this->terms_agreement_end_date = $financingAgreement->terms_agreement_end_date;
        $this->conditions_precedent = $financingAgreement->conditions_precedent;
        $this->repayment_terms = $financingAgreement->repayment_terms;
        $this->interest_rate = $financingAgreement->interest_rate;
        $this->termination_clause = $financingAgreement->termination_clause;
    }

    //For Financing Agreement
    public function deleteConfirm(AddFinancingAgreement $financingAgreement)
    {
        $this->delete_confirm = $financingAgreement;
    }


    //For Financing Agreement Attachment
    public function deleteConfirmAttachment(AddFinancingAgreementDocument $addFinancingAgreementDocument)
    {
        $this->delete_confirm = $addFinancingAgreementDocument;
    }


    //For Financing Agreement Disbursement
    public function deleteConfirmDisbursement(AddDisbursementSchedule $addDisbursementSchedule)
    {
        $this->delete_confirm = $addDisbursementSchedule;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Financing Agreement Deleted');
    }

    private function resetField()
    {
        $this->reset('agreement_title', 'attachment_title', 'financing_agreement', 'attachment', 'agreement_reference', 'funding_agency', 'total_funding_amount', 'currency', 'terms_agreement_start_date', 'finance_id', 'update', 'terms_agreement_end_date', 'conditions_precedent', 'repayment_terms', 'interest_rate', 'termination_clause');
        $this->update = false;
    }



    public function storeFinancingAgreementAttachment()
    {
        $this->validate([
            'conceptNoteId' => 'required|exists:concept_notes,id',
            'attachment_title' => 'required|string|max:255',
            'financing_agreement' => 'required',
            'attachment' => 'required|file|mimes:pdf,doc,docx,jpeg,png|max:10240',
        ]);

        if ($this->attachment) {
            // Generate a unique file name with the attachment title and a timestamp
            $filename = $this->attachment_title . '_' . time() . '.' . $this->attachment->getClientOriginalExtension();

            // Store the file in the 'public' disk under 'financing_agreement_docs' directory with the custom filename
            $filePath = $this->attachment->storeAs('financing_agreement_docs', $filename, 'public');

            // Save or update the database entry
            AddFinancingAgreementDocument::updateOrCreate(
                ['id' => $this->finance_doc_id],
                [
                    'concept_note_id' => $this->conceptNoteId,
                    'financing_agreement_id' => $this->financing_agreement,
                    'attachment_title' => $this->attachment_title,
                    'attachment' => $filePath,
                    'status' => 'allowed'
                ]
            );

            // Dispatch a sweet alert info message
            $this->dispatch('swal:info', title: $this->finance_doc_id ? 'Financing Agreement Document Updated.' : 'Financing Agreement Document Created');
            $this->resetField();

            // Close the modal
            $this->dispatch('closeModal');
        } else {
            // Flash an error message if the attachment is missing
            session()->flash('error', 'The attachment is required.');
        }
    }

    public function downloadAttachment($id)
    {
        $agreementAttachment = AddFinancingAgreementDocument::findOrFail($id);
        if ($agreementAttachment && Storage::disk('public')->exists($agreementAttachment->attachment)) {
            return response()->download(storage_path('app/public/' . $agreementAttachment->attachment));
        } else {
            session()->flash('error', 'File does not exist.');
            return redirect()->back();
        }
    }

    public function editFinancingAgreementAttachment($finance_doc_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->finance_doc_id = $finance_doc_id;

        $financingAgreementDoc = AddFinancingAgreementDocument::findOrFail($finance_doc_id);
        $this->concept_note = $financingAgreementDoc->concept_note_id;
        $this->attachment_title = $financingAgreementDoc->attachment_title;
        $this->financing_agreement = $financingAgreementDoc->financing_agreement_id;
        $this->attachment = $financingAgreementDoc->attachment;
    }





    public function storeDisbursementSchedule()
    {

        $this->validate([
            'conceptNoteId' => 'required',
            'milestone_type' => 'required|string',
            'financing_agreement_dis' => 'required',
            'installment_type' => 'required',
            'amount' => 'required',
        ]);

        // Remove commas for the numeric conversion if there are any
        $formattedAmount = str_replace(',', '', $this->amount);
        // Optionally, convert to a number to ensure it's stored as numeric in the database
        $formattedAmount = (float) $formattedAmount;

        AddDisbursementSchedule::updateOrCreate(['id' => $this->disburse_id], [
            'concept_note_id' => $this->conceptNoteId,
            'milestone_type' => $this->milestone_type,
            'schedule_date' => $this->schedule_date,
            'condition' => $this->condition,
            'installment_type' => $this->installment_type,
            'financing_agreement_id' => $this->financing_agreement_dis,
            'amount' => $formattedAmount,
        ]);


        $this->dispatch('swal:info', title: $this->disburse_id ? 'Disbursement Schedule Updated.' : 'Disbursement Schedule Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function editDisbursementSchedule($disburse_id)
    {
        logger("Editing disburse agreement: " . $disburse_id);
        $this->resetErrorBag();
        $this->update = true;
        $this->disburse_id = $disburse_id;

        $financingAgreemenDisburse = AddDisbursementSchedule::findOrFail($disburse_id);
        $this->concept_note = $financingAgreemenDisburse->concept_note_id;
        $this->milestone_type = $financingAgreemenDisburse->milestone_type;
        $this->financing_agreement = $financingAgreemenDisburse->financing_agreement_id;
        $this->installment_type = $financingAgreemenDisburse->installment_type;
        $this->schedule_date = $financingAgreemenDisburse->schedule_date;
        $this->condition = $financingAgreemenDisburse->condition;
        $this->amount = $financingAgreemenDisburse->amount;
        $this->condition = $financingAgreemenDisburse->condition;
    }




    public function render()
    {
        $financingAgreements = AddFinancingAgreement::query()->latest();
        if ($this->search_keyword) {
            $financingAgreements->where('id', $this->search_keyword)
                ->orWhere('agreement_title', 'like', '%' . $this->search_keyword . '%')->orWhere('currency', 'like', '%' . $this->search_keyword . '%')->orWhere('conditions_precedent', 'like', '%' . $this->search_keyword . '%')->orWhere('agreement_reference', 'like', '%' . $this->search_keyword . '%')->orWhere('termination_clause', 'like', '%' . $this->search_keyword . '%');
        }

        $financingAgreements = $financingAgreements->paginate();

        $financingAgreementAttachments = AddFinancingAgreementDocument::latest()->paginate();
        $financingAgreementDisburbasments = AddDisbursementSchedule::latest()->paginate();



        return view('livewire.add-financing-agreement-component', [
            'financingAgreements' => $financingAgreements,
            'financingAgreementAttachments' => $financingAgreementAttachments,
            'financingAgreementDisburbasments' => $financingAgreementDisburbasments,
            'conceptNotes' => ConceptNote::all(),
            'financing_agreements' => AddFinancingAgreement::all(),
        ])->layout('layouts.app');
    }
}
