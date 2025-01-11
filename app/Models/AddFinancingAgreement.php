<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddFinancingAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'concept_note_id',
        'agreement_title',
        'agreement_reference',
        'funding_agency',
        'total_funding_amount',
        'currency',
        'terms_agreement_start_date',
        'terms_agreement_end_date',
        'conditions_precedent',
        'repayment_terms',
        'interest_rate',
        'termination_clause',
    ];



    public function getFormattedTermsAgreementStartDateAttribute()
    {
        return $this->terms_agreement_start_date ? Carbon::parse($this->terms_agreement_start_date)->format('F j, Y') : 'Not Set';
    }

    public function getFormattedTermsAgreementEndDateAttribute()
    {
        return $this->terms_agreement_end_date ? Carbon::parse($this->terms_agreement_end_date)->format('F j, Y') : 'Not Set';
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
