<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInformationReport extends Model
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

    public function conceptNote()
    {
        return $this->belongsTo(ConceptNote::class, 'concept_note_project_id');
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