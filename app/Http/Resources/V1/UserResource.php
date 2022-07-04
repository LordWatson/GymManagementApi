<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
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
            'email' => $this->when($request->user()->isAdmin(), $this->email),
            'roles' => $this->when($request->user()->isAdmin() || $request->user()->id == Auth::id(), RoleResource::collection($this->roles)),
            'created_at' => $this->when($request->user()->isAdmin(), $this->created_at),
            'updated_at' => $this->when($request->user()->isAdmin(), $this->updated_at),
        ];
    }
}
