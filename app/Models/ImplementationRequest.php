<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImplementationRequest extends Model
{
    use HasFactory;

    protected $table = 'implementation_requests';
    protected $guarded = false;

    public function creator() : BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'implementation_request_id');
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
