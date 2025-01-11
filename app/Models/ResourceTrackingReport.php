<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceTrackingReport extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];


    protected $guarded = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function projectInformationReport()
    {
        return $this->belongsTo(ProjectInformationReport::class, 'project_info_id');
    }

    public function sourceFinance()
    {
        return $this->belongsTo(SourceFinancing::class, 'source_finance_id');
    }

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            static::creating(function ($model) {
                $model->created_by = auth()->user()->id;
            });
        }
    }
}
