<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'projectproposal_id',
        'name',
        'type',
        'status',
        'category',
        'location',
        'created_by',
    ];


    public function projectProposal()
    {
        return $this->belongsTo(ProjectProposal::class);
    }
}
