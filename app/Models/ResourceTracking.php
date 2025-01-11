<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceTracking extends Model
{
    use HasFactory;

    public function financeParticular()
    {
        return $this->belongsTo(FinanceParticular::class);
    }


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function sourceFinancing()
    {
        return $this->belongsTo(SourceFinancing::class);
    }
}
