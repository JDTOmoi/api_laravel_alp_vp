<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User_RideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ur_id' => $this->ur_id,
            'ride_id' => $this->ride_id,
            'passanger_id' => $this->passanger_id,
            'review' => $this->review,
            'price' => $this->price
        ];
    }
}
