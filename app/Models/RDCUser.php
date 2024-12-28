<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RDCUser extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'rdc_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
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
