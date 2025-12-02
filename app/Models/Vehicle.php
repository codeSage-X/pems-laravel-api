<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'license_plate',
        'fuel_level',
        'mileage',
        'status',
        'last_inspection',
        'next_inspection',
    ];

    protected $casts = [
        'last_inspection' => 'date',
        'next_inspection' => 'date',
    ];
}