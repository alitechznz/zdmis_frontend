<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionFlow extends Model
{
    use HasFactory;

    protected $fillable = [
        'conceptnote_id',
        'status',
        'comment',
        'action',
        'role_id',
        'user_id',
        'page',
    ];

    // A decision flow belongs to a concept note
    public function conceptnote()
    {
        return $this->belongsTo(ConceptNote::class);
    }


    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

}
