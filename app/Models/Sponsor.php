<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_name',
        'short_name',
        'country_id',
        'organization_category',
        'contact_person',
        'contact_details',
    ];


    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('F j, Y');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
