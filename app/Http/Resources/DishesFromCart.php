<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DishesFromCart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'          => $this->name,
            'ingredients'   => $this->ingredients,
            'price'         => $this->price,
            'quantity'      => $this->pivot->quantity ?? null,
        ];
    }
}
