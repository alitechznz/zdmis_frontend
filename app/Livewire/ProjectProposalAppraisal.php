<?php

namespace App\Livewire;
use App\Models\ProjectQuestion;
use App\Models\Screening;
use Livewire\Component;

class ProjectProposalAppraisal extends Component
{
    public $answers = [];
    public $comments = [];

    public function saveProjectDetails()
    {
        foreach ($this->answers as $questionId => $answer) {
            $comment = $this->comments[$questionId] ?? null;

            ProjectQuestion::updateOrCreate(
                ['question_id' => $questionId],
                ['answer' => $answer, 'comment' => $comment]
            );
        }
        session()->flash('message', 'Screening responses saved successfully!');
    }

    public function render()
    {
        $questions = ProjectQuestion::where('page', 'appraisal')->get();
        // Fetch all questions from the database
        return view('livewire.project-proposal-appraisal', [
            'questions' => $questions,])->layout('layouts.app');
    }
}
