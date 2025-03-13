<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;
    protected $table = 'weather_data'; // Specify the table name if not the plural of the model

    protected $fillable = [
        'city', 'high_temp', 'low_temp', 'sunrise_time', 'sunset_time', 'wind', 'waves', 'warnings'
    ];
}
