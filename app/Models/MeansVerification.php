<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeansVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectproposal_id',
        'source',
        'source_type',
        'how_data_obtained',
        'where_data_obtained',
        'status',
        'created_by',
    ];

  
    public function projectProposal()
    {
        return $this->belongsTo(ProjectProposal::class);
    }
}
