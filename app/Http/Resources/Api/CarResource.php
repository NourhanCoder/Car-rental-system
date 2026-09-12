<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'content'       => $this->content,
            'luggage'       => $this->luggage,
            'doors'         => $this->doors,
            'passengers'    => $this->passengers,
            'price'         => $this->price,
            'discount_price' => $this->discount_price,
            'image'         => $this->image ? asset('storage/' . $this->image) : null,
            // 'status'        => $this->status,
        ];
    }
}
