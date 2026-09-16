<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'car_id'        => $this->car_id,
            'pick_up_date'  => \Carbon\Carbon::parse($this->pick_up_date)->format('Y-m-d'),
            'drop_off_date' => \Carbon\Carbon::parse($this->drop_off_date)->format('Y-m-d'),
            'total_price'   => $this->total_price,
            'status'        => $this->status,
            'created_at'    => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
