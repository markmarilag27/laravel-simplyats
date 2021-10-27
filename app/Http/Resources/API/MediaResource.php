<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'uuid'                  => $this->uuid,
            'file_name'             => $this->file_name,
            'mime_type'             => $this->mime_type,
            'human_readable_size'   => $this->human_readable_size,
            'created_at_from_now'   => $this->created_at->diffForHumans(),
            'url'                   => $this->getUrl()
        ];
    }
}
