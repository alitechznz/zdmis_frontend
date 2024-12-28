<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConceptNoteProgramProject extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function conceptNote(): BelongsTo
    {
        return $this->belongsTo(ConceptNote::class, 'concept_note_id', 'id');
    }
    public function priorityArea(): BelongsTo {
        return $this->belongsTo(PriorityArea::class, 'priority_area_id', 'id');
    }

    public function strategicArea(): BelongsTo {
        return $this->belongsTo(Pillar::class, 'strategic_area_id', 'id');
    }

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
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
