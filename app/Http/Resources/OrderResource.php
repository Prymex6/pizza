<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'firstname'         => $this->firstname,
            'lastname'          => $this->lastname,
            'telephone'         => $this->telephone,
            'email'             => $this->email,
            'city'              => $this->city,
            'time'              => $this->time,
            'hour'              => $this->hour,
            'realization'       => $this->realization,
            'street'            => $this->street,
            'house_number'      => $this->house_number,
            'zip_code'          => $this->zip_code,
            'apartment_number'  => $this->apartment_number,
            'floor'             => $this->floor,
            'payment'           => $this->payment,
            'status_paid'       => $this->status_paid,
            'note'              => $this->note,
            'status_id'         => $this->status_id,
            'created_at'        => $this->getCreatedAtAttribute($this->created_at),
        ];
    }
}
