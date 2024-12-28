<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposalActivity extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function projectOutput()
    {
        return $this->belongsTo(ProjectProposalOutput::class, 'project_proposal_output_id');
    }

    public function sourceFinancing()
    {
        return $this->belongsTo(SourceFinancing::class, 'source_financing_id');
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
