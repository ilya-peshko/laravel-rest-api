<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'firstName'  => $this->first_name,
            'lastName'   => $this->last_name,
            'type'       => $this->type,
            'email'      => $this->email,
            'street'     => $this->address->street,
            'city'       => $this->address->city,
            'state'      => $this->address->state,
            'postalCode' => $this->address->postal_code,
            'invoices'   => InvoiceResource::collection($this->whenLoaded('invoices')),
        ];
    }
}
