<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetTerm extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'start_date',
        'end_date',
        'status',
    ];
}
