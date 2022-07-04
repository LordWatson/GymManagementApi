<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class GymClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->when($request->user()->isAdmin(), $this->id),
            'name' => $this->name,
            'description' => $this->description,
            'max_attendees' => $this->max_attendees,
            'attendees' => count($this->attendees->unique()),
            'start_date_time' => $this->start_date_time,
            'duration' => $this->duration,
            'frequency' => $this->frequency ?? 'One off',
            'instructor_id' => UserResource::make($this->instructor),
            'created_at' => $this->when($request->user()->isAdmin(), $this->created_at),
            'updated_at' => $this->when($request->user()->isAdmin(), $this->updated_at),
        ];
    }
}
