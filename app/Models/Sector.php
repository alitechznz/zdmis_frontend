<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ministry_id',
        'status',
    ];

    public function responsibleUser()
    {
        return $this->belongsTo(Ministry::class, 'ministry_id');
    }

    
}
