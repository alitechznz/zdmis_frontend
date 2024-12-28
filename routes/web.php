<?php

use App\Livewire\LGAComponent;
use App\Livewire\PlanComponent;
use App\Livewire\RoleComponent;
use App\Livewire\UnitComponent;
use App\Livewire\UserComponent;
use App\Livewire\PillarComponent;
use App\Livewire\ProjectProposal;
use App\Livewire\RegionComponent;
use App\Livewire\SectorComponent;
use App\Livewire\ShehiaComponent;
use App\Livewire\ProjectComponent;
use App\Livewire\RdcUserComponent;
use App\Livewire\SponsorComponent;
use App\Livewire\DistrictComponent;
use App\Livewire\MinistryComponent;
use App\Livewire\UnitUserComponent;
use App\Livewire\UnitValueComponent;
use Illuminate\Support\Facades\Auth;
use App\Livewire\AspirationComponent;
use App\Livewire\BudgetTermComponent;
use App\Livewire\DepartmentComponent;
use App\Livewire\DisbursingComponent;
use App\Livewire\MonitoringComponent;
use App\Models\RequestImplementation;
use Illuminate\Support\Facades\Route;
use App\Livewire\ConceptNoteComponent;
use App\Livewire\InstitutionComponent;
use App\Livewire\MinistryUserComponent;
use App\Livewire\NationalPlanComponent;
use App\Livewire\PriorityAreaComponent;
use App\Livewire\RegionalPlanComponent;
use App\Http\Controllers\HomeController;
use App\Livewire\MonitoringEvaluationPlanComponent;
use App\Livewire\ConceptNoteFormViewComponentw;
use App\Livewire\DocumentDownloadComponent;
use App\Livewire\LGAapproveListComponent;
use App\Livewire\LGAChallengesComponent;
use App\Livewire\MunicipalUserComponent;
use App\Livewire\ResourcesListComponent;
use App\Livewire\ScreeningListComponent;
use App\Livewire\AppraisalListComponents;
use App\Livewire\DepartmentUserComponent;
use App\Livewire\LGAConceptNoteComponent;
use App\Livewire\LGAProjectListComponent;
use App\Livewire\ProjectProposalFormView;
use App\Livewire\ConceptNoteEditComponent;
use App\Livewire\ConceptNoteFormComponent;
use App\Livewire\InstitutionUserComponent;
use App\Livewire\ProjectCalenderComponent;
use App\Livewire\ProjectProposalAppraisal;
use App\Livewire\ProjectProposalDecission;
use App\Livewire\ProjectQuestionComponent;
use App\Livewire\ShehiaCommitteeComponent;
use App\Livewire\SourceFinancingComponent;
use App\Livewire\MunicipalCouncilComponent;
use App\Livewire\ResourceTrackingComponent;
use App\Livewire\AppraisalQuestionComponent;
use App\Livewire\DomesticFinancingComponent;
use App\Livewire\FinanceParticularComponent;
use App\Livewire\InternationalPlanComponent;
use App\Livewire\MEPlanSummaryListComponent;
use App\Livewire\RegionalAuthorityComponent;
use App\Livewire\FinancingAgreementComponent;
use App\Livewire\AddResourceTrackingComponent;
use App\Livewire\ConceptNoteApprovalComponent;
use App\Livewire\ConceptNoteDecisionComponent;
use App\Livewire\ProjectProposalFormComponent;
use App\Livewire\ConceptNoteScreeningComponent;
use App\Livewire\AddFinancingAgreementComponent;
use App\Livewire\RequestImplementationComponent;
use App\Livewire\Reports\ConceptNotePDFComponent;
use App\Livewire\ViewImplementationRequestComponent;
use App\Http\Controllers\ImplementationReportController;
use App\Livewire\ManageExtensionComponent;
use App\Livewire\RequestDisbursingComponent;
use App\Livewire\RequestExtensionComponent;
use App\Livewire\ViewRequestDisbursingComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', [HomeController::class, 'index']);
Route::get('/download-pdf/{id}', [DocumentDownloadComponent::class, 'downloadPdf'])->name('download.pdf');

Route::middleware('auth')->prefix('v1')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('plans', PlanComponent::class)->name('plans');
    Route::get('pillars', PillarComponent::class)->name('pillars');
    Route::get('priority-areas', PriorityAreaComponent::class)->name('priority-areas');
    Route::get('aspirations', AspirationComponent::class)->name('aspirations');
    Route::get('national-plan', NationalPlanComponent::class)->name('national-plan');
    Route::get('regional-plan', RegionalPlanComponent::class)->name('regional-plan');
    Route::get('internation-plan', InternationalPlanComponent::class)->name('internation-plan');

    # user setup
    Route::get('ministry', MinistryComponent::class)->name('ministry');
    Route::get('institutions', InstitutionComponent::class)->name('institutions');
    Route::get('departments', DepartmentComponent::class)->name('departments');
    Route::get('divisions', UnitComponent::class)->name('divisions');
    Route::get('rd-committees', RegionalAuthorityComponent::class)->name('rd-committees');
    Route::get('municipal-councils', MunicipalCouncilComponent::class)->name('municipal-council');
    Route::get('shehia-committees', ShehiaCommitteeComponent::class)->name('shehia-committees');
    # user management
    Route::get('ministry/users', MinistryUserComponent::class)->name('ministry.users');
    Route::get('institution/users', InstitutionUserComponent::class)->name('institution.users');
    Route::get('department/users', DepartmentUserComponent::class)->name('department.users');
    Route::get('division/user', UnitUserComponent::class)->name('division.users');
    Route::get('municipal/users', MunicipalUserComponent::class)->name('municipal.users');
    Route::get('rd-committee/users', RdcUserComponent::class)->name('rd-committee.users');

    Route::get('users', UserComponent::class)->name('users');
    Route::get('roles', RoleComponent::class)->name('roles');
    # location
    Route::get('regions', RegionComponent::class)->name('regions');
    Route::get('districts', DistrictComponent::class)->name('districts');
    Route::get('shehias', ShehiaComponent::class)->name('shehias');
    # PROJECT MANAGEMENT -> BASIC SETUP
    Route::get('project-questions', ProjectQuestionComponent::class)->name('project-questions');
    Route::get('appraisal-questions', AppraisalQuestionComponent::class)->name('appraisal-questions');
    Route::get('source-financing', SourceFinancingComponent::class)->name('source-financings');
    Route::get('project-calendars', ProjectCalenderComponent::class)->name('project-calendars');
    Route::get('budget-terms', BudgetTermComponent::class)->name('budget-terms');
    Route::get('finance-particulars', FinanceParticularComponent::class)->name('finance-particulars');
    Route::get('sectors', SectorComponent::class)->name('sectors');
    Route::get('view-request-implementations', ViewImplementationRequestComponent::class)->name('view-request-implementations');
    Route::get('view-request-disbursings', ViewRequestDisbursingComponent::class)->name('view-request-disbursings');
    Route::get('request-implementations', RequestImplementationComponent::class)->name('request-implementations');
    Route::get('request-disbursings', RequestDisbursingComponent::class)->name('request-disbursings');
    Route::get('lga-challeges', LGAComponent::class)->name('lga-challeges');
    Route::get('lga-approve-list', LGAapproveListComponent::class)->name('lga-approve-list');
    Route::get('lga-project-concept-note', LGAConceptNoteComponent::class)->name('lga-project-concept-note');
    Route::get('request-extension', RequestExtensionComponent::class)->name('request-extension');
    Route::get('manage-extension', ManageExtensionComponent::class)->name('manage-extension');
    Route::get('shehias/{districtId}', [\App\Http\Controllers\ShehiaController::class, 'getByDistrict']);

    Route::get('outcomes/{id}/outputs', [\App\Http\Controllers\RequestImplementationController::class, "getOutputsByOutcome"]);
    Route::get('outputs/{id}/activities', [\App\Http\Controllers\RequestImplementationController::class, "getActivitiesByOutput"]);
    Route::get('get-project-code/{id}', [\App\Http\Controllers\RequestExtensionController::class, "getProjectCode"]);



    #Concept note
    Route::get('concept-note-list', ConceptNoteComponent::class)->name('concept-note-list');
    Route::get('concept-note-form', ConceptNoteFormComponent::class)->name('concept-note-form');
    Route::get('concept-note-view/{id}', ConceptNoteFormViewComponentw::class)->name('concept-note-view');
    Route::get('concept-note-approved', ConceptNoteApprovalComponent::class)->name('concept-note-approved');
    Route::get('concept-note-screening/{id}', ConceptNoteScreeningComponent::class)->name('concept-note-screening');
    Route::get('concept-note-decision/{id}', ConceptNoteDecisionComponent::class)->name('concept-note-decision');
    Route::get('concept-note-screening-report/{id}', ScreeningListComponent::class)->name('concept-note-screening-report');
    Route::get('concept-note-edit/{id}', ConceptNoteEditComponent::class)->name('concept-note-edit');
    Route::get('/print-concept-note/{conceptNote}', [ConceptNotePDFComponent::class, 'printConceptNotePdf'])->name('print.conceptNote');

    Route::get('lga-challenges', LGAChallengesComponent::class)->name('lga-challenges');
    Route::get('lga-concept-note', LGAConceptNoteComponent::class)->name('lga-concept-note');
    Route::get('lga-project-list', LGAProjectListComponent::class)->name('lga-project-list');

    Route::get('proposal-list', ProjectProposal::class)->name('proposal-list');
    Route::get('proposal-form/{id}', ProjectProposalFormComponent::class)->name('proposal-form');
    Route::get('proposal-form-view', ProjectProposalFormView::class)->name('proposal-form-view');
    Route::get('proposal-appraisal', ProjectProposalAppraisal::class)->name('proposal-appraisal');
    Route::get('proposal-appraisal-list', AppraisalListComponents::class)->name('proposal-appraisal-list');
    Route::get('proposal-decision', ProjectProposalDecission::class)->name('proposal-decision');

    Route::get('unit-values', UnitValueComponent::class)->name('unit-values');
    Route::get('/concept-notes/{id}/view', [ConceptNoteComponent::class, 'view'])->name('concept-notes.view');
    Route::get('/concept-notes/{id}/edit', [ConceptNoteComponent::class, 'edit'])->name('concept-notes.edit');

    # PROJECT MONITORING & SUMMARY
    Route::get('m-e-plan', MonitoringEvaluationPlanComponent::class)->name('m-e-plans');
    Route::get('m-e-plan-summary', MEPlanSummaryListComponent::class)->name('m-e-plan-summaries');

    # PROJECT
    Route::get('projects', ProjectComponent::class)->name('projects');

    # PROJECT MONITORING ===> RESOURCE TRACKING
    Route::get('resource-lists', ResourcesListComponent::class)->name('resource-lists');
    Route::get('resource-tracking', ResourceTrackingComponent::class)->name('resource-tracking');
    Route::get('add-resource-tracking', AddResourceTrackingComponent::class)->name('add-resource-tracking');
    Route::get('monitoring-form', MonitoringComponent::class)->name('monitoring-form');
    Route::get('lga-challenges', MonitoringComponent::class)->name('lga-challenges');
    Route::get('lga-concept-note', MonitoringComponent::class)->name('lga-concept-note');
    Route::get('lga-project-list', MonitoringComponent::class)->name('lga-project-list');

    Route::get('get-project-code/{projectId}', [ImplementationReportController::class, 'getProjectCode']);

    # PROJECT FINANCING
    Route::get('sponsors', SponsorComponent::class)->name('sponsors');
    Route::get('financing-agreements', FinancingAgreementComponent::class)->name('financing-agreements');
    Route::get('/add-financing-agreements/{conceptNoteId}', AddFinancingAgreementComponent::class)->name('add-financing-agreements');
    Route::get('domestic-financings', DomesticFinancingComponent::class)->name('domestic-financings');
    Route::get('disbursing', DisbursingComponent::class)->name('disbursings');
});
