<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\ConceptNote;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Component;


class HomeComponent extends Component
{
    public $t_concept = 0, $t_decision = 0, $t_decision_flow = 0, $t_proposal = 0, $t_lga = 0, $t_ppp = 0, $t_investment = 0, $t_project = 0;
    public $p_concept = 0.0, $p_decision = 0.0, $p_decision_flow = 0.0, $p_proposal = 0.0, $p_lga = 0.0, $p_ppp = 0.0, $p_investment = 0.0, $p_project = 0.0;

    public $ConceptNote;
    public function render()
    {
        // $this->t_concept = ConceptNote::whereIn('process_status', [0, 1, 2, 3, 4, 5, 10])->count();
        // $this->t_proposal = ConceptNote::where('process_status', 6)->count();

        // $this->ConceptNote = ConceptNote::with([
        //     'sector',
        //     'user',
        //     'plans',
        //     'outcome',
        //     'projectLocations',
        // ])->where('id', $id)->first();

        // $this->cn_id = $id;
        // // Set related data
        // $this->sector_name = $this->conceptNote->sector->name ?? null;
        // $this->medium_term_plan = $this->conceptNote->plan->name ?? null;
        // $this->responsible_officer = $this->conceptNote->user->name ?? null;
        // $this->administrative_unit = auth()->user()->ministryUser?->ministry->name;


        // //upcomming
        // $today = Carbon::now();
        // $upcomingDeadlines = ProjectCalender::select([
        //     'startdate',
        //     'enddate',
        //     'activity',
        //     DB::raw('DATEDIFF(startdate, CURDATE()) AS days_remaining') // Calculates days remaining until startdate
        // ])->where('startdate', '>', $today)->get();

        // foreach ($upcomingDeadlines as $deadline) {
        //     $totalDuration = $deadline->enddate->diffInDays($deadline->startdate);
        //     $daysRemaining = $deadline->days_remaining;

        //     // Avoid division by zero
        //     if ($totalDuration > 0) {
        //         $percentageRemaining = ($daysRemaining / $totalDuration) * 100;
        //     } else {
        //         $percentageRemaining = 0; // Handle cases where startdate and enddate might be the same
        //     }

        //     $deadline->percentage_remaining = round($percentageRemaining, 2);
        // }


        return view('livewire.home-component');
    }
}
