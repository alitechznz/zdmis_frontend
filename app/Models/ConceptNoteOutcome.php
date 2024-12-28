<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNoteOutcome extends Model
{
    use HasFactory;

    protected $guarded = false;


    public function conceptNote()
    {
        return $this->belongsTo(ConceptNote::class, 'conceptnote_id');

    }

    public function outputs()
{
    return $this->hasMany(ConceptNoteOutput::class, 'outcome_id');
}
}
