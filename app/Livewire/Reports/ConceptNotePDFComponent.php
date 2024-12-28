<?php

namespace App\Livewire\Reports;
use App\Models\ConceptNote;
use App\Models\ProjectQuestion;
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
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;


class ConceptNotePDFComponent extends Component
{
    // public $conceptNote;
    public $answers = [];
    public $comments = [];
    public $conceptNote = [];
    public $scores = [];
    public $sector_name, $sector_policy, $medium_term_plan, $responsible_officer, $administrative_unit;
    public $project_background, $project_justification, $proposed_outcomes, $project_outline, $financing_modality, $total_project_cost;
    public $project_outline_approach, $project_outline_outputs, $project_outline_inputs, $project_outline_timeframeResponsibility, $project_outline_sustainabilityRisk;
    public $tentative_financing_arrangement;
    public $selectedConceptNote = null;
    public $get_location =[];
    public $outcome;

    public $cn_id = 0;

    public function mount($id)
    {
        // $this->conceptNote = $conceptNote;

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
        dd($financing);

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


    public function printConceptNotePdf($id)
    {
        // $conceptNote = ConceptNote::findOrFail($id);
        // $mpdf = new Mpdf();  // Ensure Mpdf is properly installed via Composer and autoloaded

        // $viewData = view('livewire.reports.concept-note-p-d-f-component', compact('conceptNote'))->render();
        // $mpdf->WriteHTML($viewData);

        // $filename = 'ConceptNote-' . $id . '.pdf';
        // $mpdf->Output($filename, 'I'); // Sends the PDF inline to the browser
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

        $downloadLink = route('download.pdf', ['id' => $this->cn_id]);
        $qrCode = QrCode::size(60)->generate($downloadLink);


        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 15,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 0
        ]);

        // $mpdf->SetHTMLHeader($this->view('livewire.reports.partials.header', $this->conceptNote)->render());
        // $mpdf->SetHTMLFooter($this->view('livewire.reports.partials.footer')->render());


        // $html = $this->view('livewire.reports.concept-note-p-d-f-component', [
        //     'conceptNote' => $this->conceptNote
        // ])->render();

        // $mpdf->WriteHTML($html);
        // $mpdf->Output('Concept_Note_Report.pdf', 'I');


        // Render headers and footers using View facade
    // $headerHtml = View::make('livewire.reports.partials.header', ['conceptNote' => $this->conceptNote])->render();
    $footerHtml = View::make('livewire.reports.partials.footer', ['qrCode' => $qrCode])->render();

    // $mpdf->SetHTMLHeader($headerHtml);
    $mpdf->SetHTMLFooter($footerHtml);

    // Main content rendering
    $contentHtml = View::make('livewire.reports.concept-note-p-d-f-component', [
        'conceptNote' => $this->conceptNote,
        'total_project_cost' => $this->total_project_cost,
        'financing_modality'=> $this->financing_modality,
        'sector_name'=> $this->sector_name,
        'outcome'=> $this->outcome,
        'responsible_officer'=> $this->responsible_officer,
        'project_background' =>$this->project_background,
        'project_justification' =>$this->project_justification,
        'proposed_outcomes' =>$this->proposed_outcomes,
        'project_outline_approach' =>$this->project_outline_approach,
        'project_outline_outputs' =>$this->project_outline_outputs,
        'project_outline_inputs' =>$this->project_outline_inputs,
        'project_outline_timeframeResponsibility' =>$this->project_outline_timeframeResponsibility,
        'project_outline_sustainabilityRisk' =>$this->project_outline_sustainabilityRisk,
        'tentative_financing_arrangement' =>$this->tentative_financing_arrangement,
        'qrCode' => $qrCode,
        'projectLocations' => $this->conceptNote->projectLocations ?? []

    ])->render();

    $mpdf->WriteHTML($contentHtml);
    // Define the file path and name
    $filePath = storage_path("app/public/documents/{$this->cn_id}.pdf");

    // Save the PDF to the server
    $mpdf->Output($filePath, 'F');

    $mpdf->Output('Concept_Note_Report.pdf', 'I');
    }

    public function render()
    {
        return view('livewire.reports.concept-note-p-d-f-component', [
            'total_project_cost' => $this->total_project_cost
        ]);
    }
}
