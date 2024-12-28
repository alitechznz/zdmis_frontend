<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;
    protected $table = 'screenings';
    protected $fillable = [
        'conceptnote_id',
        'projectquestion_id',
        'answer',
        'section',
        'comment',
        'actiont',
        'created_by',
        'score',
    ];


    // public function conceptnote()
    // {
    //     return $this->belongsTo(ConceptNote::class);
    // }

    // public function projectquestion()
    // {
    //     return $this->belongsTo(ProjectQuestion::class);
    // }
}
