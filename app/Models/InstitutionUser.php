<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionUser extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class, 'ministry_id');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            static::creating(function ($model) {
                $model->created_by = auth()->user()->id;
            });
        }

        static::addGlobalScope('organizationalScope', function (Builder $builder) {
            $ministry_id = request()->attributes->get('institution_id');
            if ($ministry_id) {
                $builder->where('institution_id', $ministry_id);
            }
        });
    }
}
