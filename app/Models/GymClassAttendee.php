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
    ];
}
