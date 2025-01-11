<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNoteOutput extends Model
{
    use HasFactory;

    protected $fillable = [
        'conceptnote_id',
        'outcome_id',
        'name',
        'output_type',
    ];

    public function conceptNote()
    {
        return $this->belongsTo(ConceptNote::class, 'conceptnote_id');
    }

    public function outcome()
    {
        return $this->belongsTo(ConceptNoteOutcome::class, 'outcome_id');
    }
}
