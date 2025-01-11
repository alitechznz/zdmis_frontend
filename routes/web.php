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
    // Route::get('rd-committee/users', RdcUserComponent::class)->name('rd-committee.users');

    Route::get('users', UserComponent::class)->name('users');
    Route::get('roles', RoleComponent::class)->name('roles');
    # location
    Route::get('regions', RegionComponent::class)->name('regions');
    Route::get('districts', DistrictComponent::class)->name('districts');
    Route::get('shehias', ShehiaComponent::class)->name('shehias');



    #Concept note
    Route::get('forecast-list', ConceptNoteComponent::class)->name('forecast-list');

    Route::get('unit-values', UnitValueComponent::class)->name('unit-values');
    Route::get('/concept-notes/{id}/view', [ConceptNoteComponent::class, 'view'])->name('concept-notes.view');
    Route::get('/concept-notes/{id}/edit', [ConceptNoteComponent::class, 'edit'])->name('concept-notes.edit');





    # PROJECT FINANCING

});
