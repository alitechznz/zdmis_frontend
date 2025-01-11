<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposalOutput extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function projectOutcome()
    {
        return $this->belongsTo(ProjectProposalOutcome::class, 'project_proposal_outcome_id');
    }

    public function projectProposalActivities()
    {
        return $this->hasMany(ProjectProposalActivity::class);
    }

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            static::creating(function ($model) {
                $model->created_by = auth()->user()->id;
            });
        }
    }
}
