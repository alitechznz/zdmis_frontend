<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptNoteFinancing extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_financing_id',
        'type_finance_id',
        'sponsor_id',
        'currency_id',
        'total_amount',
        'compensation_cost',
        'startdate',
        'enddate',
        'status',
        'agreement_doc',
        'created_by',
    ];


    // public function conceptNote()
    // {
    //     return $this->belongsTo(ConceptNote::class, 'note_financing_id');
    // }

    public function financingType()
    {
        return $this->belongsTo(FinancingType::class, 'type_finance_id');
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'sponsor_id');
    }


    // public function currency()
    // {
    //     return $this->belongsTo(Currency::class, 'currency_id');
    // }
}
