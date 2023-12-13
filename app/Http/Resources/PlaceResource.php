<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'place_id' => $this->place_id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'address' => $this->address
        ];
    }
}
