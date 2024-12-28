<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipalCouncil extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function regionalAuthority()
    {
        return $this->belongsTo(RegionalAuthority::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
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
