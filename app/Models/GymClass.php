<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'max_attendees',
        'start_date_time',
        'duration',
        'instructor_id',
        'frequency',
    ];

    // Eager load instructor
    protected $with = ['instructor'];

    public function instructor()
    {
        return $this->hasOne(User::class, 'id','instructor_id');
    }

    public function pastAttendees()
    {
        return $this->belongsToMany(User::class, 'gym_class_attendees');
    }

    public function attendees()
    {
        return $this->pastAttendees()->where('repeated_id', $this->repeated_id);
    }
}
