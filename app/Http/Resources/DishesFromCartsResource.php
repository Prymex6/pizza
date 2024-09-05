<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DishesFromCartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'dish_id'   =>  $this->pivot->dish_id,
            'quantity'  =>  $this->pivot->quantity,
            'size_id'  =>  $this->pivot->size_id,
        ];
    }
}
