<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClassAttendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'gym_class_id',
        'user_id',
        'repeated_id',
    ];

    // Both GymClass and GymClassAttendee have a column 'repeated_id'. This is used to differentiate between
    // classes the re-occur. ie weekly, monthly etc.
}
