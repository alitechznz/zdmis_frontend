<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNotePartners extends Model
{
    use HasFactory;

    protected $fillable = [
        'concept_note_id',
        'name',
        'short_name',
        'type',
        'contact',
        'status',
        'detail',
        'created_by',
        'create_at',
    ];

    public function conceptNote()
    {
        return $this->belongsTo( ConceptNote::class, 'concept_note_id');
    }
}
