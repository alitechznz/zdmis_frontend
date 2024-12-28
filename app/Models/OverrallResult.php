<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverrallResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'screening_id',
        'result',
        'comment',
        'created_by',
        'status',
        'condition',
    ];


    public function screening()
    {
        return $this->belongsTo(Screening::class);
    }
}
