<?php

namespace App\Livewire;

use App\Models\AddFinancingAgreement;
use App\Models\ConceptNote;
use App\Models\FinancingAgreement;
use Livewire\Component;
use Livewire\WithPagination;

class FinancingAgreementComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $total_funding_amount, $agreement_reference, $termination_clause, $funding_agency, $interest_rate, $agreement_title, $currency, $repayment_terms, $terms_agreement_start_date, $finance_id, $concept_note, $terms_agreement_end_date, $conditions_precedent = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {

        $this->validate([
            'concept_note' => 'required',
            'agreement_title' => 'required',
            'agreement_reference' => 'required',
            'funding_agency' => 'required',
            'total_funding_amount' => 'required|numeric',
            'currency' => 'required',
            'terms_agreement_start_date' => 'required|date',
            'terms_agreement_end_date' => 'required|date',
            'conditions_precedent' => 'required',
            'repayment_terms' => 'required',
            'interest_rate' => 'required|numeric',
            'termination_clause' => 'required',
        ]);




        AddFinancingAgreement::updateOrCreate(['id' => $this->finance_id], [
            'concept_note_id' => $this->concept_note,
            'agreement_title' => $this->agreement_title,
            'agreement_reference' => $this->agreement_reference,
            'funding_agency' => $this->funding_agency,
            'total_funding_amount' => $this->total_funding_amount,
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

        //close modal
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

    public function deleteConfirm(AddFinancingAgreement $financingAgreement)
    {
        $this->delete_confirm = $financingAgreement;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Financing Agreement Deleted');
    }

    private function resetField()
    {
        $this->reset('agreement_title', 'agreement_reference', 'funding_agency', 'total_funding_amount', 'currency', 'terms_agreement_start_date', 'finance_id', 'update', 'terms_agreement_end_date', 'conditions_precedent', 'repayment_terms', 'interest_rate', 'termination_clause');
    }

    public function render()
    {
        $financingAgreements = AddFinancingAgreement::query()->latest();
        if ($this->search_keyword) {
            $financingAgreements->where('id', $this->search_keyword)
                ->orWhere('agreement_title', 'like', '%' . $this->search_keyword . '%')->orWhere('currency', 'like', '%' . $this->search_keyword . '%')->orWhere('conditions_precedent', 'like', '%' . $this->search_keyword . '%')->orWhere('agreement_reference', 'like', '%' . $this->search_keyword . '%')->orWhere('termination_clause', 'like', '%' . $this->search_keyword . '%');
        }

        $financingAgreements = $financingAgreements->paginate();




        return view('livewire.financing-agreement-component', [
            'financingAgreements' => $financingAgreements,
            'conceptNotes' => ConceptNote::all(),
        ])->layout('layouts.app');
    }
}
