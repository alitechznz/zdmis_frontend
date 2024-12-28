<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNoteKpi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'concept_note_output_id',
        'createdby'
    ];


    public function output()
    {
        return $this->belongsTo(ConceptNoteNutput::class, 'concept_note_output_id');
    }

}
