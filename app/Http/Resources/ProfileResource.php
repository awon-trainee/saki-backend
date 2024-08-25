<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_number' => $this->id_number,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'material_status' => $this->material_status,
            'monthly_income' => $this->monthly_income,
            'income_source' => $this->income_source
        ];
    }
}
