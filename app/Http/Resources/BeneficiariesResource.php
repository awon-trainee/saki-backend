<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiariesResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality->name_ar,
            // 'nationality' => $this->nationality,
            'gender' => $this->gender,
            'material_status' => $this->material_status,
            'monthly_income' => $this->monthly_income,
            'income_source' => $this->income_source,
            'balance' => convertToSar($this->balance->amount),
            'token' => $this->createToken('accessToken')->accessToken
        ];
    }
}
