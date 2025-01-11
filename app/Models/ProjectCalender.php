<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCalender extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity',
        'action',
        'startdate',
        'enddate',
    ];

    protected $dates = ['startdate', 'enddate'];

    // Cast dates automatically

    // Or you can use the $casts property as follows
    protected $casts = [
        'startdate' => 'datetime',
        'enddate' => 'datetime',
    ];

    public function getRemainingDaysAttribute()
    {
        return Carbon::parse($this->enddate)->diffInDays(Carbon::parse($this->startdate), false);
    }

    // Optionally, include a method to determine the badge class based on remaining days
    public function getBadgeClassAttribute()
    {
        $remainingDays = $this->remaining_days;
        if ($remainingDays > 5) {
            return 'bg-success';
        } elseif ($remainingDays > 0) {
            return 'bg-warning';
        } else {
            return 'bg-danger';
        }
    }
}
