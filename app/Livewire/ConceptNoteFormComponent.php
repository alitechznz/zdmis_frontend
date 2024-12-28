<?php

namespace App\Livewire;

use App\Models\ConceptNote;
use App\Models\Sector;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ConceptNoteFormComponent extends Component
{

    use WithPagination;
    public $is_step1 = false, $is_step2 = false, $is_step21 = false, $is_step3 = false, $is_step4 = false, $is_step5 = false;
    public $selectedLocationLevel = "Shehia";
    public $concept_note_id, $concept_note = null;
    public $selected_class = 'Project';

    protected $listeners = ['conceptNoteSaved' => 'updateConceptNoteId', 'isFinished' => 'updateStep'];

    public function mount(): void
    {
        $concept_note = ConceptNote::where('createdby', Auth::id())->where('process_status', 0)->where('type', 'National Concept Note')->latest()->first();
        if ($concept_note) {
            $this->concept_note_id = $concept_note->id;
            $this->concept_note = $concept_note;
        }
        if ($concept_note?->outcome) {
            $this->is_step1 = true;
        }
        if ($concept_note?->projectLocations->count() > 0) {
            $this->is_step2 = true;
        }
        if($concept_note?->explaination()->whereNotNull('justification')->exists()){
            $this->is_step3 = true;
        }
        if($concept_note?->explaination()->whereNotNull('outputs')->exists()){
            $this->is_step4 = true;
        }
        if($concept_note?->finacialAggrement){
            $this->is_step5 = true;
        }
    }

    public function updateConceptNoteId($id): void
    {
        $this->concept_note_id = $id;
    }

    public function updateStep($step): void
    {
        if ($step == 'step 1') {
            $this->is_step1 = true;
        }
        if ($step == 'step 2') {
            $this->is_step2 = true;
        }
        if ($step == 'step 3') {
            $this->is_step3 = true;
        }
        if ($step == 'step 4') {
            $this->is_step4 = true;
        }
        if ($step == 'step 5') {
            $this->is_step5 = true;
        }
        if ($step == 'step 21') {
            $this->is_step21 = true;
        }
    }

    public function updatedSelectedClass(): void
    {
        $this->dispatch('selectedClass', $this->selected_class);
    }

    public $active_tab = "general_details";
    public $sectors = [];
    public function switchTab($active_tab): void
    {
        $this->active_tab = $active_tab;
        if($active_tab == "general_details"){
            $this->sectors = Sector::all();
        }
    }

    public function render()
    {
        return view('livewire.concept-note-form-component')->layout('layouts.app');
    }
}
