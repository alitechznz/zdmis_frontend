<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddlgaApproveList extends Model
{
    use HasFactory;

    protected $casts = [
        'start_time_period' => 'datetime',
        'end_time_period' => 'datetime',
    ];

    protected $guarded = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sourceFinancing()
    {
        return $this->belongsTo(SourceFinancing::class, 'source_of_fund_id');
    }

    public function conceptNote()
    {
        return $this->belongsTo(ConceptNote::class, 'concept_note_id');
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