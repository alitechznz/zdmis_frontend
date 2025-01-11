<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\MinistryUser;
use App\Models\InstitutionUser;
use App\Models\DepartmentUser;
use App\Models\Ministry;
use App\Models\Institution;
use App\Models\Department;
use App\Models\DecisionFlow;

class ConceptNote extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $casts = [
        'selected_plans' => 'array',
        'startdate' => 'datetime',
        'enddate' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'createdby');
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
    public function explaination(){
        return $this->hasOne(ConceptNoteExplanation::class, 'conceptNote_id');
    }
    public function finacialAggrement(){
        return $this->hasOne(ConceptNoteFinanceArrangement::class, 'concept_note_id');
    }
    public function plans()
    {
        return $this->hasMany(Plan::class, 'id', 'selected_plans');
    }
    public function outcome() : HasOne {
        return $this->hasOne(ConceptNoteOutcome::class, 'conceptnote_id');
    }
    public function projectLocations() : HasMany {
        return $this->hasMany(ConceptNoteLocation::class, 'concept_note_id');
    }
    public function projectPrograms() : HasMany {
        return $this->hasMany(ConceptNoteProgramProject::class, 'concept_note_id');
    }
    public function projectProposalOutcomes() : HasMany {
        return $this->hasMany(ProjectProposalOutcome::class, 'concept_note_id');
    }
    public function projectProposalOutputs() : HasMany {
        return $this->hasMany(ProjectProposalOutput::class, 'concept_note_id');
    }
    public function projectProposalActivities() : HasMany {
        return $this->hasMany(ProjectProposalActivity::class, 'concept_note_id');
    }
    public function projectProposalIndicators() : HasMany {
        return $this->hasMany(ProjectProposalIndicator::class, 'concept_note_id');
    }
    public function projectProposalAttachments() : HasMany {
        return $this->hasMany(ProjectProposalAttachment::class, 'concept_note_id');
    }

    public function organization() : BelongsTo {
        return $this->belongsTo(Ministry::class, 'organization_name');
    }

    // In ConceptNote model
    public function decisionFlows()
    {
        return $this->hasMany(DecisionFlow::class, 'conceptnote_id');
    }
     protected static function boot()
     {
         parent::boot();

         if (auth()->check()) {
             static::creating(function ($model) {
                 $model->createdby = auth()->user()->id;
             });
         }

         static::addGlobalScope('organizationalScope', function (Builder $builder) {
             if (auth()->check()) {
                 $user = auth()->user();

                 if ($user->hasAnyRole(['ZPS Officer', 'PS', 'ES', 'Commissioner Planning', 'Commissioner M&E', 'Planning Desk Officer']) ){
                     return;
                 }

                 $builder->where(function ($query) use ($user) {
                     // Fetch the IDs for all institutions under the ministry if the user has a ministry
                     $ministry_id = optional($user->ministryUser)->ministry_id;
                     if ($ministry_id) {
                         // Assuming institutions have a 'ministry_id' field linking back to their ministry
                         $institution_ids = Institution::where('ministry_id', $ministry_id)->pluck('id');

                         // Allow access to concept notes from the ministry itself
                         $query->orWhereHas('user.ministryUser', function ($subQuery) use ($ministry_id) {
                             $subQuery->where('ministry_id', $ministry_id);
                         });
                         // Also include all institutions under this ministry
                         if($user->hasAnyRole(['DPPR','PS','Minister'])) {
                             if ($institution_ids->isNotEmpty()) {
                                 $query->orWhereHas('user.institutionUser', function ($subQuery) use ($institution_ids) {
                                     $subQuery->whereIn('institution_id', $institution_ids);
                                 });
                             }
                         }
                     }

                     // Access control for individual institution users
                     $institution_id = optional($user->institutionUser)->institution_id;
                     if ($institution_id) {
                         $query->orWhereHas('user.institutionUser', function ($subQuery) use ($institution_id) {
                             $subQuery->where('institution_id', $institution_id);
                         });
                     }

                     // Access control for department users
                     $department_id = optional($user->departmentUser)->department_id;
                     if ($department_id) {
                         $query->orWhereHas('user.departmentUser', function ($subQuery) use ($department_id) {
                             $subQuery->where('department_id', $department_id);
                         });
                     }

                     // Access control for department users
                     $municipal_id = optional($user->municipalUser)->municipal_id;
                     if ($municipal_id) {
                         $query->orWhereHas('user.municipalUser', function ($subQuery) use ($municipal_id) {
                             $subQuery->where('municipal_id', $municipal_id);
                         });
                     }

                     // Access control for department users
                     $rdc_id = optional($user->rdcUser)->region_id;
                     if ($rdc_id) {
                         $query->orWhereHas('user.rdcUser', function ($subQuery) use ($rdc_id) {
                             $subQuery->where('region_id', $rdc_id);
                         });
                     }
                 });
             }
         });

     }
}
