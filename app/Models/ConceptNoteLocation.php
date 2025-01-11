<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNoteLocation extends Model
{
    use HasFactory;
    protected $table = 'concept_note_locations';

    protected $fillable = [
        'location_name',
        'location_level',
        'location_id',
        'concept_note_id',
    ];
}
