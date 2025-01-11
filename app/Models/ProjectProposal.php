<?php

namespace App\Models;

use App\MeansVerification;
use App\ProjectActivity;
use App\ProjectFile;
use App\RiskAssumption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'conceptnote_id',
        'sector',
        'type',
        'question_number',
        'status',
        'section_number',
        'created_by',
    ];


    public function conceptnote()
    {
        return $this->belongsTo(ConceptNote::class);
    }
    public function riskAssumptions()
    {
        return $this->hasMany(RiskAssumption::class);
    }
    public function meansVerifications()
    {
        return $this->hasMany(MeansVerification::class);
    }
    public function projectFiles()
    {
        return $this->hasMany(ProjectFile::class);
    }
    public function projectActivits()
{
    return $this->hasMany(ProjectActivity::class);
}
}
