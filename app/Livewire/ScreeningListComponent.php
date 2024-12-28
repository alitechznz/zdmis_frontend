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
use App\Models\ConceptNoteFinanceArrangement;
use App\Models\ConceptNoteFinancing;

use Livewire\Component;

class ScreeningListComponent extends Component
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
    //    $this->conceptNote = ConceptNote::where('id', $id)->first();
       $this->conceptNote = ConceptNote::with([
            'sector',
            'user',
            'plans',
            'outcome',
            'projectLocations',
        ])->where('id', $id)->first();

        $this->cn_id = $id;
        // Set related data
        $this->sector_name = $this->conceptNote->sector->name ?? null;
        $this->medium_term_plan = $this->conceptNote->plan->name ?? null;
        $this->responsible_officer = $this->conceptNote->user->name ?? null;
        $this->administrative_unit = auth()->user()->ministryUser?->ministry->name;


        // Explanations
        $explanations = ConceptNoteExplanation::where('conceptNote_id', $id)->first();
        $financing = ConceptNoteFinanceArrangement::where('concept_note_id', $id)->first();

        $this->project_background = $explanations->background ?? null;
        $this->project_justification = $explanations->justification ?? null;
        $this->proposed_outcomes = $explanations->outcomes ?? null;
        $this->project_outline_approach = $explanations->overall_approach ?? null;
        $this->project_outline_outputs = $explanations->outputs ?? null;
        $this->project_outline_inputs = $explanations->overall_inputs ?? null;
        $this->project_outline_timeframeResponsibility  = $explanations->timeframeResponsibility  ?? null;
        $this->project_outline_sustainabilityRisk = $explanations->overall_sustainabilityRisk ?? null;

        $this->financing_modality = $financing->financing_modality ?? null;
        $this->total_project_cost  = $financing->total_project_cost  ?? null;
        $this->tentative_financing_arrangement  = $financing->tentative_financing_arrangement ?? null;
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


    // Define validation rules as a property


    public function saveProjectDetails()
    {
        $this->loading = true;

        try {
            // Dynamically generate validation rules

            // Dynamically generate validation rules
            $rules = [
                'answers.*' => 'required|string',
                'comments.*' => 'nullable|string',
            ];

            foreach ($this->scores as $questionId => $score) {
                $maxScore = ProjectQuestion::find($questionId)->score_weight; // Get max score from DB
                $rules["scores.$questionId"] = "required|numeric|min:0|max:$maxScore";
            }

            // Validate the scores
            $this->validate($rules);


            foreach ($this->answers as $questionId => $answer) {
                $comment = $this->comments[$questionId] ?? null;
                $score = $this->scores[$questionId] ?? 0; // Ensure score is assigned correctly

                Screening::updateOrCreate(
                    ['question_id' => $questionId, 'conceptnote_id' => $this->cn_id],
                    ['answer' => $answer, 'comment' => $comment, 'score' => $score]
                );
            }

            $this->dispatch('swal', title:'Screening responses saved successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->dispatch('swal', title: $e->getMessage());
            // Optionally, log the error or handle it differently
           // Log::error("Error saving screening responses: " . $e->getMessage());
        }

        $this->loading = false;
    }
    public function render()
    {
        $questions = ProjectQuestion::where('page', 'screening')->get();
        return view('livewire.screening-list-component',[
            'questions' => $questions,
            'conceptNote' => $this->conceptNote,
            'sector_name' => $this->sector_name,
            'sector_policy' => $this->sector_policy,
        ])->layout('layouts.app');
    }
}
