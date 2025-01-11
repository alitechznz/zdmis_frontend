<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssumption extends Model
{
    use HasFactory;
    protected $fillable = [
        'projectproposal_id',
        'name',
        'type',
        'details',
        'status',
        'created_by',
    ];

   
    public function projectProposal()
    {
        return $this->belongsTo(ProjectProposal::class);
    }
}
