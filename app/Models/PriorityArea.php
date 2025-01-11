<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriorityArea extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pillar()
    {
        return $this->belongsTo(Pillar::class, 'pillar_id');
    }

    public function projectProposalIndicators()
    {
        return $this->hasMany(ProjectProposalIndicator::class);
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
