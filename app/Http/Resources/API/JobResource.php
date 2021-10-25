<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'uuid'          => $this->uuid,
            'title'         => $this->title,
            'location'      => $this->location,
            'environment'   => $this->environment,
            'type'          => $this->type,
            'experience'    => $this->experience,
            'description'   => $this->description,
            'status'        => $this->status,
            'author'        => new UserResource($this->whenLoaded('user')),
            'updated_at'    => $this->updated_at,
            'created_at'    => $this->created_at
        ];
    }
}