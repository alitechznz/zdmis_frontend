<?php

namespace App\Livewire;

use App\Models\ProjectQuestion;
use Livewire\Component;
use Livewire\WithPagination;

class AppraisalQuestionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $page = 'appraisal';
    public $score_weight = 0;
    public $sub_section = null;

    public $title, $section, $number, $result, $section_number, $projectquestion_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'page' => 'required',
            'section' => 'required',
            'result' => 'nullable',
            'number' => 'required|numeric|min:1', 
            'section_number' => 'required|numeric|min:1',
            'score_weight' => 'nullable|numeric|min:0',
        ]);
        ProjectQuestion::updateOrCreate(['id' => $this->projectquestion_id], [
            'title' => $this->title,
            'page' => $this->page,
            'section' => $this->section,
            'number' => $this->number,
            'result' => $this->result,
            'section_number' => $this->section_number,
            'score_weight' => $this->score_weight,
            'sub_section' => $this->sub_section,
        ]);

        $this->dispatch('swal:info', title: $this->projectquestion_id ? 'ProjectQuestion Updated.' : 'ProjectQuestion Created');

        $this->resetField();

        //close modal
        $this->dispatch('closeModal');
    }

    public function edit($projectquestion_id)
    {
        $this->resetErrorBag();
        $this->update  = true;
        $this->projectquestion_id = $projectquestion_id;

        $projectquestion = ProjectQuestion::findOrFail($projectquestion_id);
        $this->title = $projectquestion->title;
        $this->page = $projectquestion->page;
        $this->section = $projectquestion->section;
        $this->number = $projectquestion->number;
        // $this->result = $projectquestion->result;
        $this->section_number = $projectquestion->section_number;
        $this->sub_section = $projectquestion->sub_section;
        $this->score_weight = $projectquestion->score_weight;
    }

    public function deleteConfirm(ProjectQuestion $projectquestion)
    {
        $this->delete_confirm = $projectquestion;
    }

    public function destroy()
    {
        $this->delete_confirm->delete();
        $this->dispatch('swal:info', title: 'Project Question Deleted');
    }

    private function resetField()
    {
        $this->reset('title', 'page', 'sub_section','score_weight', 'section', 'number', 'result', 'section_number', 'projectquestion_id', 'update');
    }

    public function render()
    {
        $appraisalquestions = ProjectQuestion::query()
            ->where('page', 'appraisal')
            ->latest();

        if ($this->search_keyword) {
            $appraisalquestions->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('title', 'like', '%' . $this->search_keyword . '%')
                    ->orWhere('section', 'like', '%' . $this->search_keyword . '%');
            });
        }

        $appraisalquestions = $appraisalquestions->paginate();

        return view('livewire.appraisal-question-component', [
            'appraisalquestions' => $appraisalquestions
        ])->layout('layouts.app');
    }
}
