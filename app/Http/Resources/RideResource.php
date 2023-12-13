<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ride_id' => $this->ride_id,
            'driver_id' => $this->driver_id,
            'status' => $this->status,
            'start_location' => $this->start_location,
            'destination_location' => $this->destination_location,
            'going_time' => $this->going_time,
            'car_model' => $this->car_model,
            'car_plate_number' => $this->car_plate_number
        ];
    }
}
