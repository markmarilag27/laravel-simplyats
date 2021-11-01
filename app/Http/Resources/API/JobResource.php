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
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'uuid'                      => $this->uuid,
            'title'                     => $this->title,
            'location'                  => $this->location,
            'environment'               => $this->environment,
            'type'                      => $this->type,
            'experience'                => $this->experience,
            'description'               => $this->description,
            'status'                    => $this->status,
            'author'                    => new UserResource($this->whenLoaded('user')),
            'applicants_total'          => $this->applicants_count ?? 0,
            'updated_at'                => $this->updated_at,
            'updated_at_from_now'       => $this->updated_at->diffForHumans(),
            'created_at'                => $this->created_at,
            'created_at_from_now'       => $this->created_at->diffForHumans(),
        ];
    }
}
