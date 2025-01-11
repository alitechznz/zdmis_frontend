<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalDecisionFlow extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'role_id',
        'officer_status',
        'comment',
        'action',
        'decision_status',
    ];

    // public function proposal()
    // {
    //     return $this->belongsTo(Proposal::class);
    // }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }
}
