<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function institution()
    {

        return $this->belongsTo(Institution::class);
    }



    // Relationship with Ministry
    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    // Dynamic relationship based on 'under' attribute
    public function parent()
    {
        if ($this->under === 'Institution') {
            return $this->institution();
        } elseif ($this->under === 'Ministry') {
            return $this->ministry();
        }

        return null; // or throw an exception if 'under' is not set properly
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
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