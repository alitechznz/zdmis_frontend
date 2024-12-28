<?php

namespace App\Livewire;

use App\Models\ConceptNote;
use App\Models\RequestImplementation;
use Livewire\Component;
use Livewire\WithPagination;

class ViewRequestDisbursingComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $project_title, $file_type, $attachement, $requested_status, $requested_id = null;
    public  $concept_note, $concept_note_id;

    public function mount()
    {
        $this->concept_note = ConceptNote::where('process_status', 6)->get();
    }


    public function render()
    {
        $this->concept_note = ConceptNote::where('process_status', 6)->get();
        if ($this->concept_note) {
            // $this->concept_note_id = $concept_note->id;
        }

        $requestImplementations = RequestImplementation::query()->latest();
        if ($this->search_keyword) {
            $requestImplementations->where('id', $this->search_keyword)
                ->orWhere('project_title', 'like', '%' . $this->search_keyword . '%')->orWhere('requested_status', 'like', '%' . $this->search_keyword . '%');
        }

        $requestImplementations = $requestImplementations->paginate();


        return view('livewire.view-request-disbursing-component', [
            'requestImplementations' => $requestImplementations,
            'concept_note' => $this->concept_note
        ])->layout('layouts.app');
    }
}
