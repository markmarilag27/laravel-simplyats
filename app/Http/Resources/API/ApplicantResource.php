<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'uuid'              => $this->uuid,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'location'          => $this->location,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'status'            => $this->status,
            'job'               => new JobResource($this->whenLoaded('job')),
            'updated_at'        => $this->updated_at,
            'created_at'        => $this->created_at
        ];
    }
}
