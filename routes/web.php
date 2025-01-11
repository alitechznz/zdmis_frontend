<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\ConceptNoteComponent;
use App\Http\Controllers\HomeController;
use App\Livewire\WeatherDataFeedComponent;
use App\Livewire\WeatherAlertComponent;
use App\Livewire\DocumentDownloadComponent;


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
    // Route::get('ministry', MinistryComponent::class)->name('ministry');
    // Route::get('institutions', InstitutionComponent::class)->name('institutions');
    // Route::get('departments', DepartmentComponent::class)->name('departments');
    // Route::get('divisions', UnitComponent::class)->name('divisions');
    // Route::get('rd-committees', RegionalAuthorityComponent::class)->name('rd-committees');
    // Route::get('municipal-councils', MunicipalCouncilComponent::class)->name('municipal-council');
    // Route::get('shehia-committees', ShehiaCommitteeComponent::class)->name('shehia-committees');
    # user management
    // Route::get('ministry/users', MinistryUserComponent::class)->name('ministry.users');
    // Route::get('institution/users', InstitutionUserComponent::class)->name('institution.users');
    // Route::get('department/users', DepartmentUserComponent::class)->name('department.users');
    // Route::get('division/user', UnitUserComponent::class)->name('division.users');
    // Route::get('municipal/users', MunicipalUserComponent::class)->name('municipal.users');
    // Route::get('rd-committee/users', RdcUserComponent::class)->name('rd-committee.users');

    // Route::get('users', UserComponent::class)->name('users');
    // Route::get('roles', RoleComponent::class)->name('roles');
    // # location
    // Route::get('regions', RegionComponent::class)->name('regions');
    // Route::get('districts', DistrictComponent::class)->name('districts');
    // Route::get('shehias', ShehiaComponent::class)->name('shehias');



    #Concept note
    Route::get('/forecast-list', ConceptNoteComponent::class)->name('forecast-list');
    Route::get('/reporting-data', WeatherDataFeedComponent::class)->name('reporting-data');
    Route::get('/reporting-alerts', WeatherAlertComponent::class)->name('reporting-alerts');

    // Route::get('unit-values', UnitValueComponent::class)->name('unit-values');
    // Route::get('/concept-notes/{id}/view', [ConceptNoteComponent::class, 'view'])->name('concept-notes.view');
    // Route::get('/concept-notes/{id}/edit', [ConceptNoteComponent::class, 'edit'])->name('concept-notes.edit');


    // Route::get('lang/{language}', function ($language) {
    //     Session::put('locale', $language);
    //     return back();
    // })->name('switchLang');



    # PROJECT FINANCING

});
