<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPlanFinance extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectactivity_id',
        'amount',
        'currency',
        'status',
        'sponser_id',
        'created_by',
    ];

   
    public function projectActivity()
    {
        return $this->belongsTo(ProjectActivity::class, 'projectactivity_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

   
    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'sponser_id');
    }
}
