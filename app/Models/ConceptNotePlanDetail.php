<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNotePlanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'concept_note_id',
        'project_detail_type',
        'project_detail',
        'detail_status',
        'detail_create_at',
        'detail_created_by',
    ];

    public function conceptNote()
    {
        return $this->belongsTo(ConceptNote::class, 'concept_note_id');
    }
}
