<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'promo_id' => $this->promo_id,
            'name' => $this->name,
            'promo_code' => $this->promo_code,
            'promo_exp' => $this->promo_exp
        ];
    }
}
