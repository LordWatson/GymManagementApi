<?php
/**
 * Custom validation rule to check if a user ID can instruct a gym class
 * See app/Models/User.php - canInstructGymClass()
 *
 * @author Alex Watson
 */

namespace App\Rules\V1;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class GymClassInstructorIsQualifiedRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $instructor = User::find($value);

        return $instructor->canInstructGymClass();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Instructor is not qualified to teach a gym class';
    }
}
