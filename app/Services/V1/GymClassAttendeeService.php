<?php

namespace App\Services\V1;

use App\Models\GymClass;
use App\Models\GymClassAttendee;
use App\Models\User;
use App\Models\UserRole;

class GymClassAttendeeService
{
    public function __construct()
    {
        //
    }

    public function isUserAlreadyAttendingClass($userId, $gymClassId) : bool
    {
        $gymClass = GymClass::find($gymClassId);

        if(
            GymClassAttendee::where('gym_class_id', $gymClassId)
                ->where('repeated_id', $gymClass->repeated_id)
                ->where('user_id', $userId)
                ->exists()
        ){
            return true;
        }
        return false;
    }

    public function doesGymClassHaveSpace($gymClassId) : bool
    {
        $gymClass = GymClass::find($gymClassId);

        if(
            $gymClass->max_attendees
            >
            GymClassAttendee::where('gym_class_id', $gymClassId)
                ->where('repeated_id', $gymClass->repeated_id)
                ->count()
        ){
            return true;
        }
        return false;
    }
}
