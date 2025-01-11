<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baseline extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function kpi()
    {
        return $this->belongsTo(KPI::class, 'kpi_id');
    }

    public function unitValue()
    {
        return $this->belongsTo(UnitValue::class, 'unit_id');
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
