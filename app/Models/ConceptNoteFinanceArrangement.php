<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNoteFinanceArrangement extends Model
{
    use HasFactory;
    protected $table = 'concept_note_finance_arrangement';
    protected $guarded = false;

    public function project()
    {
        return $this->belongsTo(ConceptNote::class, 'concept_note_id');
    }

}
