<?php

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\BaselineController;
use App\Http\Controllers\ImplementationRequestController;
use App\Http\Controllers\KPIController;
use App\Http\Controllers\MunicipalUserController;
use App\Http\Controllers\RDCUserController;
use App\Http\Controllers\RoleAndPermissionController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\UnitUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentUserController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\InstitutionUserController;
use App\Http\Controllers\MinistryUserController;
use App\Http\Controllers\RegionalAuthorityController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\MunicipalCouncilController;
use App\Http\Controllers\PriorityAreaController;
use App\Http\Controllers\PillarController;
use App\Http\Controllers\ShehiaCommitteeController;
use App\Http\Controllers\ConceptNoteController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ShehiaController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProjectCalenderController;
use App\Http\Controllers\BudgetTermController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\ConceptNotePartnerController;
use App\Http\Controllers\ConceptNoteFinancingController;
use App\Http\Controllers\ConceptNoteOutcomeController;
use App\Http\Controllers\FinancingTypeController;
use App\Http\Controllers\ConceptNotePlanTargetController;
use App\Http\Controllers\DecisionFlowController;
use App\Http\Controllers\ProjectQuestionController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\ProjectProposalController;
use App\Http\Controllers\MeansVerificationController;
use App\Http\Controllers\RiskAssumptionController;
use App\Http\Controllers\ProjectFileController;
use App\Http\Controllers\ProjectActivityController;
use App\Http\Controllers\ActivityPlanFinanceController;
use App\Http\Controllers\ProposalDecisionFlowController;
use App\Http\Controllers\FinanceParticularController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SubmissionTimelineController;
use App\Http\Controllers\SourceFinancingController;
use App\Http\Controllers\ImplementationReportController;
use App\Http\Controllers\ConceptNoteExplanationController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('ministries', [MinistryController::class, 'index']);
    Route::post('ministries', [MinistryController::class, 'storeOrUpdate']);
    Route::get('ministries/{id}', [MinistryController::class, 'show']);
    Route::post('ministries/status/{id}', [MinistryController::class, 'changeStatus']);
    Route::delete('ministries/{id}', [MinistryController::class, 'destroy']);
    # institution
    Route::get('institutions', [InstitutionController::class, 'index']);
    Route::get('institutions/create', [InstitutionController::class, 'create']);
    Route::post('institutions', [InstitutionController::class, 'storeOrUpdate']);
    Route::get('institutions/{id}', [InstitutionController::class, 'show']);
    Route::post('institutions/status/{id}', [InstitutionController::class, 'changeStatus']);
    Route::delete('institutions/{id}', [InstitutionController::class, 'destroy']);
    # department
    Route::get('departments', [DepartmentController::class, 'index']);
    Route::get('departments/create', [DepartmentController::class, 'create']);
    Route::post('departments', [DepartmentController::class, 'storeOrUpdate']);
    Route::get('departments/{id}', [DepartmentController::class, 'show']);
    Route::post('departments/status/{id}', [DepartmentController::class, 'changeStatus']);
    Route::delete('departments/{id}', [DepartmentController::class, 'destroy']);
    # unit
    Route::get('units', [UnitController::class, 'index']);
    Route::get('units/create', [UnitController::class, 'create']);
    Route::post('units', [UnitController::class, 'storeOrUpdate']);
    Route::get('units/{id}', [UnitController::class, 'show']);
    Route::post('units/status/{id}', [UnitController::class, 'changeStatus']);
    Route::delete('units/{id}', [UnitController::class, 'destroy']);
    # region
    Route::get('regions', [RegionController::class, 'index']);
    Route::post('regions', [RegionController::class, 'storeOrUpdate']);
    Route::get('regions/{id}', [RegionController::class, 'show']);
    Route::post('regions/status/{id}', [RegionController::class, 'changeStatus']);
    Route::delete('regions/{id}', [RegionController::class, 'destroy']);
    # district
    Route::get('districts', [DistrictController::class, 'index']);
    Route::get('districts/create', [DistrictController::class, 'create']);
    Route::post('districts', [DistrictController::class, 'storeOrUpdate']);
    Route::get('districts/{id}', [DistrictController::class, 'show']);
    Route::post('districts/status/{id}', [DistrictController::class, 'changeStatus']);
    Route::delete('districts/{id}', [DistrictController::class, 'destroy']);
    # shehia
    Route::get('shehias', [ShehiaController::class, 'index']);
    Route::get('shehias/create', [ShehiaController::class, 'create']);
    Route::post('shehias', [ShehiaController::class, 'storeOrUpdate']);
    Route::get('shehias/{id}', [ShehiaController::class, 'show']);
    Route::post('shehias/status/{id}', [ShehiaController::class, 'changeStatus']);
    Route::delete('shehias/{id}', [ShehiaController::class, 'destroy']);
    # regional authority
    Route::get('regional-authorities', [RegionalAuthorityController::class, 'index']);
    Route::get('regional-authorities/create', [RegionalAuthorityController::class, 'create']);
    Route::post('regional-authorities', [RegionalAuthorityController::class, 'storeOrUpdate']);
    Route::get('regional-authorities/{id}', [RegionalAuthorityController::class, 'show']);
    Route::delete('regional-authorities/{id}', [RegionalAuthorityController::class, 'destroy']);
    # municipal council
    Route::get('municipal-councils', [MunicipalCouncilController::class, 'index']);
    Route::get('municipal-councils/create', [MunicipalCouncilController::class, 'create']);
    Route::post('municipal-councils', [MunicipalCouncilController::class, 'storeOrUpdate']);
    Route::get('municipal-councils/{id}', [MunicipalCouncilController::class, 'show']);
    Route::post('municipal-councils/status/{id}', [MunicipalCouncilController::class, 'changeStatus']);
    Route::delete('municipal-councils/{id}', [MunicipalCouncilController::class, 'destroy']);
    # shehia committee
    Route::get('shehia-committees', [ShehiaCommitteeController::class, 'index']);
    Route::get('shehia-committees/create', [ShehiaCommitteeController::class, 'create']);
    Route::post('shehia-committees', [ShehiaCommitteeController::class, 'storeOrUpdate']);
    Route::get('shehia-committees/{id}', [ShehiaCommitteeController::class, 'show']);
    Route::post('shehia-committees/status/{id}', [ShehiaCommitteeController::class, 'changeStatus']);
    Route::delete('shehia-committees/{id}', [ShehiaCommitteeController::class, 'destroy']);
    # plan
    Route::get('plans', [PlanController::class, 'index']);
    Route::post('plans', [PlanController::class, 'storeOrUpdate']);
    Route::get('plans/{id}', [PlanController::class, 'show']);
    Route::post('plans/status/{id}', [PlanController::class, 'changeStatus']);
    Route::delete('plans/{id}', [PlanController::class, 'destroy']);
    # goal
    Route::get('goals', [GoalController::class, 'index']);
    Route::get('goals/create', [GoalController::class, 'create']);
    Route::post('goals', [GoalController::class, 'storeOrUpdate']);
    Route::get('goals/{id}', [GoalController::class, 'show']);
    Route::post('goals/status/{id}', [GoalController::class, 'changeStatus']);
    Route::delete('goals/{id}', [GoalController::class, 'destroy']);
    # pillar
    Route::get('pillars', [PillarController::class, 'index']);
    Route::get('pillars/create', [PillarController::class, 'create']);
    Route::post('pillars', [PillarController::class, 'storeOrUpdate']);
    Route::get('pillars/{id}', [PillarController::class, 'show']);
    Route::post('pillars/status/{id}', [PillarController::class, 'changeStatus']);
    Route::delete('pillars/{id}', [PillarController::class, 'destroy']);
    # priority area
    Route::get('priority-areas', [PriorityAreaController::class, 'index']);
    Route::get('priority-areas/create', [PriorityAreaController::class, 'create']);
    Route::post('priority-areas', [PriorityAreaController::class, 'storeOrUpdate']);
    Route::get('priority-areas/{id}', [PriorityAreaController::class, 'show']);
    Route::post('priority-areas/status/{id}', [PriorityAreaController::class, 'changeStatus']);
    Route::delete('priority-areas/{id}', [PriorityAreaController::class, 'destroy']);
    # ministry user
    Route::get('ministry-users', [MinistryUserController::class, 'index']);
    Route::get('ministry-users/create', [MinistryUserController::class, 'create']);
    Route::post('ministry-users', [MinistryUserController::class, 'storeOrUpdate']);
    Route::get('ministry-users/{id}', [MinistryUserController::class, 'show']);
    Route::delete('ministry-users/{id}', [MinistryUserController::class, 'destroy']);
    # institution user
    Route::get('institution-users', [InstitutionUserController::class, 'index']);
    Route::get('institution-users/create', [InstitutionUserController::class, 'create']);
    Route::post('institution-users', [InstitutionUserController::class, 'storeOrUpdate']);
    Route::get('institution-users/{id}', [InstitutionUserController::class, 'show']);
    Route::post('institution-users/status/{id}', [InstitutionUserController::class, 'changeStatus']);
    Route::delete('institution-users/{id}', [InstitutionUserController::class, 'destroy']);
    # department user
    Route::get('department-users', [DepartmentUserController::class, 'index']);
    Route::post('department-users', [DepartmentUserController::class, 'storeOrUpdate']);
    Route::get('department-users/{id}', [DepartmentUserController::class, 'show']);
    Route::post('department-users/status{id}', [DepartmentUserController::class, 'changeStatus']);
    Route::delete('department-users/{id}', [DepartmentUserController::class, 'destroy']);
    # unit user
    Route::get('unit-users', [UnitUserController::class, 'index']);
    Route::post('unit-users', [UnitUserController::class, 'storeOrUpdate']);
    Route::get('unit-users/{id}', [UnitUserController::class, 'show']);
    Route::post('unit-users/status/{id}', [UnitUserController::class, 'changeStatus']);
    Route::delete('unit-users/{id}', [UnitUserController::class, 'destroy']);
    # municipal user
    Route::get('municipal-users', [MunicipalUserController::class, 'index']);
    Route::post('municipal-users', [MunicipalUserController::class, 'storeOrUpdate']);
    Route::get('municipal-users/{id}', [MunicipalUserController::class, 'show']);
    Route::post('municipal-users/status/{id}', [MunicipalUserController::class, 'changeStatus']);
    Route::delete('municipal-users/{id}', [MunicipalUserController::class, 'destroy']);
    # department user
    Route::get('rdc-users', [RDCUserController::class, 'index']);
    Route::post('rdc-users', [RDCUserController::class, 'storeOrUpdate']);
    Route::get('rdc-users/{id}', [RDCUserController::class, 'show']);
    Route::post('rdc-users/status/{id}', [RDCUserController::class, 'changeStatus']);
    Route::delete('rdc-users/{id}', [RDCUserController::class, 'destroy']);
    # kpi
    Route::get('kpi', [KPIController::class, 'index']);
    Route::get('kpi/create', [KPIController::class, 'create']);
    Route::post('kpi', [KPIController::class, 'storeOrUpdate']);
    Route::get('kpi/{id}', [KPIController::class, 'show']);
    Route::post('kpi/status/{id}', [KPIController::class, 'changeStatus']);
    Route::delete('kpi/{id}', [KPIController::class, 'destroy']);
    # aspiration
    Route::get('aspirations', [AspirationController::class, 'index']);
    Route::get('aspirations/create', [AspirationController::class, 'create']);
    Route::post('aspirations', [AspirationController::class, 'storeOrUpdate']);
    Route::get('aspirations/{id}', [AspirationController::class, 'show']);
    Route::post('aspirations/status/{id}', [AspirationController::class, 'changeStatus']);
    Route::delete('aspirations/{id}', [AspirationController::class, 'destroy']);
    # baseline
    Route::get('baselines', [BaselineController::class, 'index']);
    Route::get('baselines/create', [BaselineController::class, 'create']);
    Route::post('baselines', [BaselineController::class, 'storeOrUpdate']);
    Route::get('baselines/{id}', [BaselineController::class, 'show']);
    Route::post('baselines/status/{id}', [BaselineController::class, 'changeStatus']);
    Route::delete('baselines/{id}', [BaselineController::class, 'destroy']);
    # target
    Route::get('targets', [TargetController::class, 'index']);
    Route::get('targets/create', [TargetController::class, 'create']);
    Route::post('targets', [TargetController::class, 'storeOrUpdate']);
    Route::get('targets/{id}', [TargetController::class, 'show']);
    Route::post('targets/status/{id}', [TargetController::class, 'changeStatus']);
    Route::delete('targets/{id}', [TargetController::class, 'destroy']);
    # implementation request
    Route::get('implementation-request', [ImplementationRequestController::class, 'index']);
    Route::post('implementation-request', [ImplementationRequestController::class, 'storeOrUpdate']);
    Route::get('implementation-request/{id}', [ImplementationRequestController::class, 'show']);
    Route::get('implementation-request/verify/{id}', [ImplementationRequestController::class, 'verified']);
    Route::post('implementation-request/status/{id}', [ImplementationRequestController::class, 'changeStatus']);
    Route::delete('implementation-request/{id}', [ImplementationRequestController::class, 'destroy']);

    # project calender
    Route::get('project-calenders', [ProjectCalenderController::class, 'index']);
    Route::get('project-calenders/{id}', [ProjectCalenderController::class, 'show']);
    Route::post('project-calenders', [ProjectCalenderController::class, 'storeOrUpdate']);
    Route::delete('project-calenders/{id}', [ProjectCalenderController::class, 'destroy']);

    # budget term
    Route::get('budget-terms', [BudgetTermController::class, 'index']);
    Route::get('budget-terms/{id}', [BudgetTermController::class, 'show']);
    Route::post('budget-terms', [BudgetTermController::class, 'storeOrupdate']);
    Route::delete('budget-terms/{id}', [BudgetTermController::class, 'destroy']);

    # country
    Route::get('countries', [CountryController::class, 'index']);
    Route::get('countries/{id}', [CountryController::class, 'show']);
    Route::post('countries', [CountryController::class, 'storeOrUpdate']);
    Route::put('countries/{id}', [CountryController::class, 'storeOrUpdate']);
    Route::delete('countries/{id}', [CountryController::class, 'destroy']);

    # sponsor
    Route::get('sponsors', [SponsorController::class, 'index']);
    Route::get('sponsors/{id}', [SponsorController::class, 'show']);
    Route::post('sponsors', [SponsorController::class, 'storeOrupdate']);
    Route::delete('sponsors/{id}', [SponsorController::class, 'destroy']);

    # concept note
    Route::get('concept-notes', [ConceptNoteController::class, 'index']);
    Route::get('concept-notes/{id}', [ConceptNoteController::class, 'show']);
    Route::post('concept-notes', [ConceptNoteController::class, 'storeOrupdate']);
    Route::delete('concept-notes/{id}', [ConceptNoteController::class, 'destroy']);

    #concept note partners
    Route::get('concept-note-partners', [ConceptNotePartnerController::class, 'index']);
    Route::get('concept-note-partners/{id}', [ConceptNotePartnerController::class, 'show']);
    Route::post('concept-note-partners', [ConceptNotePartnerController::class, 'storeOrUpdate']);
    Route::delete('concept-note-partners/{id}', [ConceptNotePartnerController::class, 'destroy']);

    #concept note fanacning
    Route::get('concept-note-financings', [ConceptNoteFinancingController::class, 'index']);
    Route::get('concept-note-financings/{id}', [ConceptNoteFinancingController::class, 'show']);
    Route::post('concept-note-financings', [ConceptNoteFinancingController::class, 'storeOrUpdate']);
    Route::delete('concept-note-financings/{id}', [ConceptNoteFinancingController::class, 'destroy']);

    #Concept Note Outcome
    Route::get('concept-note-outcomes', [ConceptNoteOutcomeController::class, 'index']);
    Route::get('concept-note-outcomes/{id}', [ConceptNoteOutcomeController::class, 'show']);
    Route::post('concept-note-outcomes', [ConceptNoteOutcomeController::class, 'storeOrUpdate']);
    Route::delete('concept-note-outcomes/{id}', [ConceptNoteOutcomeController::class, 'destroy']);
    #conncept output

    Route::get('concept-note-outputs', [ConceptNoteOutcomeController::class, 'index']);
    Route::get('concept-note-outputs/{id}', [ConceptNoteOutcomeController::class, 'show']);
    Route::post('concept-note-outputs', [ConceptNoteOutcomeController::class, 'storeOrUpdate']);
    Route::delete('concept-note-outputs/{id}', [ConceptNoteOutcomeController::class, 'destroy']);

    #Financing Type;
    Route::get('financing-types', [FinancingTypeController::class, 'index']);
    Route::get('financing-types/{id}', [FinancingTypeController::class, 'show']);
    Route::post('financing-types', [FinancingTypeController::class, 'storeOrUpdate']);
    Route::delete('financing-types/{id}', [FinancingTypeController::class, 'destroy']);

    #conceptplan target controller
    Route::get('concept-note-plan-targets', [ConceptNotePlanTargetController::class, 'index']);
    Route::get('concept-note-plan-targets/{id}', [ConceptNotePlanTargetController::class, 'show']);
    Route::post('concept-note-plan-targets', [ConceptNotePlanTargetController::class, 'storeOrUpdate']);
    Route::delete('concept-note-plan-targets/{id}', [ConceptNotePlanTargetController::class, 'destroy']);
    #Decision flow
    Route::get('decision-flows', [DecisionFlowController::class, 'index']);
    Route::get('decision-flows/{id}', [DecisionFlowController::class, 'show']);
    Route::post('decision-flows', [DecisionFlowController::class, 'storeOrUpdate']);
    Route::delete('decision-flows/{id}', [DecisionFlowController::class, 'destroy']);

    #project question
    Route::get('/project-questions', [ProjectQuestionController::class, 'index']);
    Route::get('/project-questions/{id}', [ProjectQuestionController::class, 'show']);
    Route::post('/project-questions', [ProjectQuestionController::class, 'storeOrUpdate']);
    Route::put('/project-questions', [ProjectQuestionController::class, 'storeOrUpdate']);
    Route::delete('/project-questions/{id}', [ProjectQuestionController::class, 'destroy']);

    #screening
    Route::get('/screenings', [ScreeningController::class, 'index']);
    Route::get('/screenings/{id}', [ScreeningController::class, 'show']);
    Route::post('/screenings', [ScreeningController::class, 'storeOrUpdate']);
    Route::put('/screenings', [ScreeningController::class, 'storeOrUpdate']);
    Route::delete('/screenings/{id}', [ScreeningController::class, 'destroy']);

    #project proposal
    Route::get('/project-proposals', [ProjectProposalController::class, 'index']);
    Route::get('/project-proposals/{id}', [ProjectProposalController::class, 'show']);
    Route::post('/project-proposals', [ProjectProposalController::class, 'storeOrUpdate']);
    Route::put('/project-proposals', [ProjectProposalController::class, 'storeOrUpdate']);
    Route::delete('/project-proposals/{id}', [ProjectProposalController::class, 'destroy']);
    #means
    Route::get('/means-verifications', [MeansVerificationController::class, 'index']);
    Route::get('/means-verifications/{id}', [MeansVerificationController::class, 'show']);
    Route::post('/means-verifications', [MeansVerificationController::class, 'storeOrUpdate']);
    Route::put('/means-verifications', [MeansVerificationController::class, 'storeOrUpdate']);
    Route::delete('/means-verifications/{id}', [MeansVerificationController::class, 'destroy']);

    #risk
    Route::get('/risk-assumptions', [RiskAssumptionController::class, 'index']);
    Route::get('/risk-assumptions/{id}', [RiskAssumptionController::class, 'show']);
    Route::post('/risk-assumptions', [RiskAssumptionController::class, 'storeOrUpdate']);
    Route::put('/risk-assumptions', [RiskAssumptionController::class, 'storeOrUpdate']);
    Route::delete('/risk-assumptions/{id}', [RiskAssumptionController::class, 'destroy']);

    #project files
    Route::get('/project-files', [ProjectFileController::class, 'index']);
    Route::get('/project-files/{id}', [ProjectFileController::class, 'show']);
    Route::post('/project-files', [ProjectFileController::class, 'storeOrUpdate']);
    Route::put('/project-files', [ProjectFileController::class, 'storeOrUpdate']);
    Route::delete('/project-files/{id}', [ProjectFileController::class, 'destroy']);

    #project activity
    Route::get('/project-activities', [ProjectActivityController::class, 'index']);
    Route::get('/project-activities/{id}', [ProjectActivityController::class, 'show']);
    Route::post('/project-activities', [ProjectActivityController::class, 'storeOrUpdate']);
    Route::put('/project-activities', [ProjectActivityController::class, 'storeOrUpdate']);
    Route::delete('/project-activities/{id}', [ProjectActivityController::class, 'destroy']);

    #activity-plan-finances
    Route::get('/activity-plan-finances', [ActivityPlanFinanceController::class, 'index']);
    Route::get('/activity-plan-finances/{id}', [ActivityPlanFinanceController::class, 'show']);
    Route::post('/activity-plan-finances', [ActivityPlanFinanceController::class, 'storeOrUpdate']);
    Route::put('/activity-plan-finances', [ActivityPlanFinanceController::class, 'storeOrUpdate']);
    Route::delete('/activity-plan-finances/{id}', [ActivityPlanFinanceController::class, 'destroy']);

    #Dicision-flow
    Route::get('/proposal-decision-flows', [ProposalDecisionFlowController::class, 'index']);
    Route::get('/proposal-decision-flows/{id}', [ProposalDecisionFlowController::class, 'show']);
    Route::post('/proposal-decision-flows', [ProposalDecisionFlowController::class, 'storeOrUpdate']);
    Route::put('/proposal-decision-flows/{id}', [ProposalDecisionFlowController::class, 'storeOrUpdate']);
    Route::delete('/proposal-decision-flows/{id}', [ProposalDecisionFlowController::class, 'destroy']);

    #finance particular
    Route::get('/finance-particulars', [FinanceParticularController::class, 'index']);
    Route::get('/finance-particulars/{id}', [FinanceParticularController::class, 'show']);
    Route::post('/finance-particulars', [FinanceParticularController::class, 'storeOrUpdate']);
    Route::put('/finance-particulars/{id}', [FinanceParticularController::class, 'storeOrUpdate']);
    Route::delete('/finance-particulars/{id}', [FinanceParticularController::class, 'destroy']);

    #sector
    Route::get('/sectors', [SectorController::class, 'index']);
    Route::get('/sectors/{id}', [SectorController::class, 'show']);
    Route::post('sectors', [SectorController::class, 'storeOrUpdate']);
    // Route::put('/sectors/{id}', [SectorController::class, 'storeOrUpdate']);
    Route::delete('/sectors/{id}', [SectorController::class, 'destroy']);

    #submmision
    Route::get('/timelines', [SubmissionTimelineController::class, 'index']);
    Route::get('/timelines/{id}', [SubmissionTimelineController::class, 'show']);
    Route::post('/timelines', [SubmissionTimelineController::class, 'storeOrUpdate']);
    Route::put('/timelines/{id}', [SubmissionTimelineController::class, 'storeOrUpdate']);
    Route::delete('/timelines/{id}', [SubmissionTimelineController::class, 'destroy']);

    #source
    Route::get('/source-financings', [SourceFinancingController::class, 'index']);
    Route::get('/source-financings/{id}', [SourceFinancingController::class, 'show']);
    Route::post('/source-financings', [SourceFinancingController::class, 'storeOrUpdate']);
    Route::put('/source-financings/{id}', [SourceFinancingController::class, 'storeOrUpdate']);
    Route::delete('/source-financings/{id}', [SourceFinancingController::class, 'destroy']);

    #Report implementation
    Route::get('/implementation-reports', [ImplementationReportController::class, 'index']);
    Route::get('/implementation-reports/{id}', [ImplementationReportController::class, 'show']);
    Route::post('/implementation-reports', [ImplementationReportController::class, 'storeOrUpdate']);
    Route::delete('/implementation-reports/{id}', [ImplementationReportController::class, 'destroy']);

    #explanation
    Route::get('/concept-note-explanations', [ConceptNoteExplanationController::class, 'index']);
    Route::get('/concept-note-explanations/{id}', [ConceptNoteExplanationController::class, 'show']);
    Route::post('/concept-note-explanations', [ConceptNoteExplanationController::class, 'storeOrUpdate']);
    Route::delete('/concept-note-explanations/{id}', [ConceptNoteExplanationController::class, 'destroy']);

    # Role
    Route::get('/roles', [RoleAndPermissionController::class, 'index']);
    Route::post('/roles', [RoleAndPermissionController::class, 'storeOrUpdate']);
    Route::delete('/roles/{id}', [RoleAndPermissionController::class, 'destroy']);
    # Permission
    Route::get('/roles/{role}/permissions', [RoleAndPermissionController::class, 'getPermissions']);
    Route::post('/roles/{role}/permissions', [RoleAndPermissionController::class, 'storePermission']);

});
