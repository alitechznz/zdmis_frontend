<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'page',
        'section',
        'number',
        'result',
        'section_number',
        'created_by',
        'score_weight',
        'sub_section'
    ];

    public function screening()
    {
        return $this->hasMany(Screening::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
