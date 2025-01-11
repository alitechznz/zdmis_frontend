<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPI extends Model
{
    use HasFactory;
    protected $table = 'kpi';

    protected $guarded = false;

    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }

    public function priorityArea()
    {
        return $this->belongsTo(PriorityArea::class, 'priority_area_id');
    }

    public function target()
    {
        return $this->belongsTo(Target::class, 'target_id');
    }

    public function baselines()
    {
        return $this->belongsTo(Baseline::class, 'baseline_id');
    }


    public function aspiration()
    {
        return $this->belongsTo(Aspiration::class, 'aspiration_id');
    }

    public function projectProposalIndicators()
    {
        return $this->hasMany(ProjectProposalIndicator::class);
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
