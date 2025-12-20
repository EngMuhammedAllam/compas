<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoolingSensor;
use App\Models\TemperatureReading;
use App\Models\TemperatureAlert;
use App\Notifications\TemperatureThresholdExceeded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class SensorApiController extends Controller
{
    public function ingest(Request $request)
    {
        $validated = $request->validate([
            'sensor_key' => 'required|string|exists:cooling_sensors,sensor_key',
            'temperature' => 'required|numeric',
        ]);

        $sensor = CoolingSensor::where('sensor_key', $validated['sensor_key'])->firstOrFail();

        // 1. Record the reading
        $reading = TemperatureReading::create([
            'cooling_sensor_id' => $sensor->id,
            'temperature' => $validated['temperature'],
            'created_at' => now(),
        ]);

        // 2. Check thresholds
        $alertTriggered = false;
        $thresholdType = null;
        $thresholdValue = null;

        if ($validated['temperature'] >= $sensor->max_threshold) {
            $alertTriggered = true;
            $thresholdType = 'high';
            $thresholdValue = $sensor->max_threshold;
        } elseif ($validated['temperature'] <= $sensor->min_threshold) {
            $alertTriggered = true;
            $thresholdType = 'low';
            $thresholdValue = $sensor->min_threshold;
        }

        if ($alertTriggered) {
            $alert = TemperatureAlert::create([
                'cooling_sensor_id' => $sensor->id,
                'temperature' => $validated['temperature'],
                'threshold_type' => $thresholdType,
                'threshold_value' => $thresholdValue,
                'severity' => 'critical',
            ]);

            // Notify admins
            $admins = User::all(); // In a real app, filter for relevant admins
            Notification::send($admins, new TemperatureThresholdExceeded($alert));
        }

        return response()->json([
            'status' => 'success',
            'alert_triggered' => $alertTriggered,
            'reading' => $reading
        ]);
    }
}
