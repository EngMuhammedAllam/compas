<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureReading extends Model
{
    public $timestamps = false;
    protected $table = 'temperature_readings';
    protected $fillable = ['cooling_sensor_id', 'temperature', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function sensor()
    {
        return $this->belongsTo(CoolingSensor::class, 'cooling_sensor_id');
    }
}
