<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddLgaChallenge extends Model
{
    use HasFactory;

    protected $casts = [
        'date_identified' => 'datetime',
    ];

    protected $guarded = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function shehia()
    {
        return $this->belongsTo(Shehia::class, 'shehia_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
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
