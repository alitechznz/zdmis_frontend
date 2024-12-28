<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'projectproposal_id',
        'output_id',
        'name',
        'type',
        'status',
        'gfscode',
        'startdate',
        'enddate',
        'created_by',
    ];
    public function projectProposal()
    {
        return $this->belongsTo(ProjectProposal::class);
    }
    public function activityPlanFinances()
    {
        return $this->hasMany(ActivityPlanFinance::class, 'projectactivity_id');
    }
}
