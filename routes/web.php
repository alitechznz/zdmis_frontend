<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\ConceptNoteComponent;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WeatherDataFeedController;
use App\Livewire\WeatherDataFeedComponent;
use App\Http\Controllers\WeatherAlertController;
use App\Livewire\WeatherAlertComponent;
use App\Livewire\MatukioComponent;
use App\Livewire\DocumentDownloadComponent;
use App\Livewire\ImportWeatherPdf;
use App\Livewire\WeatherSatelliteComponent;
use App\Livewire\Login;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\mainPageController;
use App\Http\Controllers\majukumuController;
use App\Http\Controllers\ElimuMafunzoController;
use App\Http\Controllers\NjeDashibodiController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\WasilishaTukioController;
use App\Livewire\DepartmentComponent;
use App\Livewire\Disaster\DisasterAnalysisComponent;
use App\Livewire\Disaster\DisasterSituationComponent;
use App\Livewire\Disaster\DisasterSourceComponent;
use App\Livewire\DistrictComponent;
use App\Livewire\ElimuMafunzo;
use App\Livewire\InstitutionComponent;
use App\Livewire\MinistryComponent;
use App\Livewire\MunicipalCouncilComponent;
use App\Livewire\RegionalAuthorityComponent;
use App\Livewire\RegionComponent;
use App\Livewire\ShehiaComponent;
use App\Livewire\Standard\StandardComponent;
use App\Livewire\UserComponent;
use App\Livewire\Weather\WeatherSourceComponent;
use Mpdf\Shaper\Indic;

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

Route::get('/login', [mainPageController::class, 'index'])->name('login');
Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/elimu', [ElimuMafunzoController::class, 'index'])->name('elimu');
Route::get('/tukio', [WasilishaTukioController::class, 'index'])->name('tukio');
Route::get('/nje', [NjeDashibodiController::class, 'index'])->name('nje');
Route::get('/subscriber', [SubscriberController::class, 'index'])->name('subscriber');


Route::get('/download-pdf/{id}', [DocumentDownloadComponent::class, 'downloadPdf'])->name('download.pdf');
Route::middleware(['auth.token'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('/dashboard');

    //usajili wa majukumu
    Route::get('/majukumu', [majukumuController::class, 'index'])->name('/majukumu');
    Route::get('/majukumu/create', [majukumuController::class, 'create'])->name('create');

    // Web Routes
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //weather
    Route::get('/import-tma-pdf', ConceptNoteComponent::class)->name('import-tma-pdf');

    Route::get('/forecast-list', WeatherSatelliteComponent::class)->name('forecast-list');
    Route::get('/reporting-data', WeatherDataFeedComponent::class)->name('reporting-data');
    Route::get('/reporting-alerts', WeatherAlertComponent::class)->name('reporting-alerts');
    Route::get('/tma-dashboard', WeatherAlertComponent::class)->name('tma-dashboard');

    Route::get('/matukiolist', MatukioComponent::class)->name('matukiolist');

    #Region
    Route::get('/region', RegionComponent::class)->name('region');

    #District
    Route::get('/district', DistrictComponent::class)->name('district');

    #Shehia
    Route::get('/shehia', ShehiaComponent::class)->name('shehia');

    #Disaster
    Route::get('/disaster-source', DisasterSourceComponent::class)->name('disaster-source');
    Route::get('/disaster-situation', DisasterSituationComponent::class)->name('disaster-situation');
    Route::get('/disaster-analysis', DisasterAnalysisComponent::class)->name('disaster-analysis');

    #Weather source
    Route::get('/weather-source', WeatherSourceComponent::class)->name('weather-source');


    #Standard
    Route::get('/standard', StandardComponent::class)->name('standard');

    # user setup
    Route::get('user', UserComponent::class)->name('user');

    Route::get('ministry', MinistryComponent::class)->name('ministry');
    Route::get('institutions', InstitutionComponent::class)->name('institutions');
    Route::get('departments', DepartmentComponent::class)->name('departments');
    Route::get('rd-committees', RegionalAuthorityComponent::class)->name('rd-committees');
    Route::get('municipal-councils', MunicipalCouncilComponent::class)->name('municipal-council');
});
