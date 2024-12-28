<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddDisbursementSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'financing_agreement_id',
        'milestone_type',
        'schedule_date',
        'condition',
        'installment_type',
        'amount',
        'concept_note_id',
    ];



    public function getFormattedScheduleDate()
    {
        return $this->schedule_date ? Carbon::parse($this->schedule_date)->format('F j, Y') : 'Not Set';
    }

    public function conceptNote()
    {
        return $this->belongsTo(ConceptNote::class, 'concept_note_id');
    }



    public function financeAgreement()
    {
        return $this->belongsTo(AddFinancingAgreement::class, 'financing_agreement_id');
    }
}
