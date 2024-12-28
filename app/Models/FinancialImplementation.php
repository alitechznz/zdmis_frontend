<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialImplementation extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];


    protected $guarded = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function conceptNote()
    {
        return $this->belongsTo(ConceptNote::class, 'concept_note_id');
    }

    public function outcome()
    {
        return $this->belongsTo(ProjectProposalOutcome::class, 'outcome_proposal_id');
    }

    public function output()
    {
        return $this->belongsTo(ProjectProposalOutput::class, 'output_proposal_id');
    }

    public function proposalActivity()
    {
        return $this->belongsTo(ProjectProposalActivity::class, 'activity_proposal_id');
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