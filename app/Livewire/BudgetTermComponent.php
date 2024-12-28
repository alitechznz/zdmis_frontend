<?php

namespace App\Livewire;

use App\Models\BudgetTerm;
use Livewire\Component;
use Livewire\WithPagination;

class BudgetTermComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $year, $start_date, $end_date, $status, $budgetterm_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'year' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        BudgetTerm::updateOrCreate(['id' => $this->budgetterm_id], [
            'year' => $this->year,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:info', title: $this->budgetterm_id ? 'Budget Term Updated.' : 'Budget Term Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($budgetterm_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->budgetterm_id = $budgetterm_id;

        $budgetterm = BudgetTerm::findOrFail($budgetterm_id);
        $this->year = $budgetterm->year;
        $this->start_date = $budgetterm->start_date;
        $this->end_date = $budgetterm->end_date;
        $this->status = $budgetterm->status;
    }

    public function deleteConfirm(BudgetTerm $budgetterm)
    {
        $this->delete_confirm = $budgetterm;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Budget Term Deleted');
    }

    private function resetField()
    {
        $this->reset('year', 'start_date', 'end_date', 'status', 'budgetterm_id', 'update');
    }

    public function render()
    {
        $budgetterms = BudgetTerm::query()->latest();
        if ($this->search_keyword) {
            $budgetterms->where('id', $this->search_keyword)
                ->orWhere('year', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        }

        $budgetterms = $budgetterms->paginate();


        return view('livewire.budget-term-component', [
            'budgetterms' => $budgetterms
        ])->layout('layouts.app');
    }
}
