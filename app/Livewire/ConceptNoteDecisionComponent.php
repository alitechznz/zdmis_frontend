<?php

namespace App\Livewire;
use App\Models\ProjectQuestion;
use App\Models\ConceptNote;
use App\Models\Sector;
use App\Models\ConceptNoteExplanation;
use App\Models\ConceptNoteLocation;
use App\Models\ConceptNoteOutcome;
use App\Models\Ministry;
use App\Models\Institution;
use App\Models\Region;
use App\Models\District;
use App\Models\Shehia;
use App\Models\Screening;
use App\Models\DecisionFlow;
use App\Models\ConceptNoteFinanceArrangement;
use App\Models\ConceptNoteFinancing;

use Livewire\Component;

class ConceptNoteDecisionComponent extends Component
{
    public $answers = [];
    public $comments = [];
    public $conceptNote = [];
    public $scores = [];
    public $sector_name, $sector_policy, $medium_term_plan, $responsible_officer, $administrative_unit;
    public $project_background, $project_justification, $proposed_outcomes, $project_outline, $financing_modality, $total_project_cost;
    public $project_outline_approach, $project_outline_outputs, $project_outline_inputs, $project_outline_timeframeResponsibility, $project_outline_sustainabilityRisk;
    public $tentative_financing_arrangement;
    public $cn_id = 0;
    public $loading = false;


    public function mount($id){
        $this->cn_id = $id;
    }

    public $selectedConceptNote = null;

    public function loadConceptNote($id)
    {
        $this->selectedConceptNote = ConceptNote::findOrFail($id);
        if($this->selectedConceptNote){
            // dd($this->selectedConceptNote->sector_id);
            $this->sector_name = Sector::where('id', $this->selectedConceptNote->sector_id)->first();
            $this->sector_name = $this->sector_name?->name;
        }

    }


    public function render()
    {
        
        $feedback = DecisionFlow::where('page', 'Concept')->where('conceptnote_id', $this->cn_id)->get();
        $ConceptNote = ConceptNote::where('id', $this->cn_id)->first();
        
        return view('livewire.concept-note-decision-component',[
            'conceptnote'=>$ConceptNote,
            'feedback' =>$feedback
        ])->layout('layouts.app');
    }
}
