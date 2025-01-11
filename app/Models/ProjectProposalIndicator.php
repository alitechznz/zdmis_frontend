<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposalIndicator extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function indicator()
    {
        return $this->belongsTo(KPI::class, 'indicator_id');
    }

    public function priorityArea()
    {
        return $this->belongsTo(PriorityArea::class, 'priority_area_id');
    }

    public function projectProposalOutput()
    {
        return $this->belongsTo(ProjectProposalOutput::class, 'project_proposal_output_id');
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
