<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImplementationReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectactivity_id',
        'indicator_id',
        'baseline_id',
        'result_value',
        'result_value_percentage',
        'remark',
        'status',
        'createdby',
    ];

   
    public function projectActivity()
    {
        return $this->belongsTo(ProjectActivity::class);
    }

    // public function indicator()
    // {
    //     return $this->belongsTo(Indicator::class);
    // }

    public function baseline()
    {
        return $this->belongsTo(Baseline::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'createdby');
    }
}
