<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNotePlanBaseline extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_id', 
        'baseline_id', 
        'status', 
        'value', 
        'unit', 
        'year', 
        'created_by',
    ];

    public function kpi()
    {
        return $this->belongsTo(ConceptNoteKpi::class, 'kpi_id');
    }
}
