<?php

namespace App\Http\Resources;

use App\Models\TrackingBeneficiary;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackingBeneficaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'market' => $this->market?->name,
            'charity' => $this->operation == TrackingBeneficiary::TRANSFER ? $this->beneficiary->user->charity_name : null,
            'today' => $this->created_at->isToday(),
            'day' => $this->created_at->format('l'),
            'time' => $this->created_at->toTimeString(),
            'date' => $this->created_at->toDateString(),
            'operation' => $this->operation,
            'amount' => convertToSar($this->amount)
        ];
    }
}
