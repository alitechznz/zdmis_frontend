<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceFinancing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'category',
        'level',
    ];

    public function projectProposalActivities()
    {
        return $this->hasMany(ProjectProposalActivity::class);
    }
}
