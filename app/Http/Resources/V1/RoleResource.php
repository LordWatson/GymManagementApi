<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            //'created_at' => $this->when($request->user()->isAdmin(), $this->created_at),
            //'updated_at' => $this->when($request->user()->isAdmin(), $this->updated_at),
        ];
    }
}
