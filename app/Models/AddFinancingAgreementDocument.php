<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddFinancingAgreementDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'concept_note_id',
        'financing_agreement_id',
        'attachment_title',
        'attachment',
        'status',
    ];


    public function conceptNote()
    {
        return $this->belongsTo(ConceptNote::class, 'concept_note_id');
    }


    public function financeAgreement()
    {
        return $this->belongsTo(AddFinancingAgreement::class, 'financing_agreement_id');
    }
}
