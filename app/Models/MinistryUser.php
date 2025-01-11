<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MinistryUser extends Model
{
    use HasFactory, HasRoles;

    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class, 'ministry_id');
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
            $ministry_id = request()->attributes->get('ministry_id');
            if ($ministry_id) {
                $builder->where('ministry_id', $ministry_id);
            }
        });
    }
}
