<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class CreateGymClassRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|max:50',
            'instructor_id' => 'required|exists:users,id',
            'max_attendees' => 'integer',
            'start_date_time' => 'required',
            'duration' => 'required',
        ];
    }
}
