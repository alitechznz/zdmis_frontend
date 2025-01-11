<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_term',
        'report_type',
        'date',
    ];
}
