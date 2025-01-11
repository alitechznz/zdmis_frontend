<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function institutions()
    {
        return $this->hasMany(Institution::class);
    }


    public function getAllUnits()
    {
        return $this->institutions()
            ->with('departments.units')
            ->get()
            ->pluck('departments.*.units')
            ->flatten();
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
