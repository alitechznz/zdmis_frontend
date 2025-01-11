<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNotePlanTarget extends Model
{
    use HasFactory;
    protected $fillable = [
        'kpi_id',
        'concept_note_plan_baseline_id',
        'status',
        'value',
        'unit',
        'year',
        'created_by',
    ];


    public function targets()
    {
        return $this->hasMany(ConceptNotePlanTarget::class, 'concept_note_plan_baseline_id');
    }
}
