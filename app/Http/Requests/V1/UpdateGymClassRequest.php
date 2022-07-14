<?php

namespace App\Http\Requests\V1;

use App\Rules\V1\GymClassInstructorIsQualifiedRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGymClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'unique:gym_classes,name|max:20',
            'description' => 'max:50',
            'instructor_id' => new GymClassInstructorIsQualifiedRule(),
            'max_attendees' => 'integer',
        ];
    }
}
