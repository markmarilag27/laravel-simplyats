<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'uuid'                           => $this->uuid,
            'name'                           => $this->name,
            'email'                          => $this->email,
            'email_verified_at'              => $this->email_verified_at,
            'updated_at'                     => $this->updated_at,
            'updated_at_from_now'            => $this->updated_at,
            'created_at'                     => $this->created_at,
            'created_at_from_now'            => $this->created_at,
        ];
    }
}
