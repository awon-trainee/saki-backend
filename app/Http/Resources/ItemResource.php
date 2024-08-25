<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'item_id' => $this->id,
        //     'name' => $this->daleelStoreMarket->product,
        //     'description' => $this->market->description,
        //     'price' => convertToSar($this->daleelStoreMarket->price),
        // ];
        return [
            'item_id' => $this->id,
            'name' => $this->value,
            'description' => $this->resalProduct->description,
            'price' => $this->price_with_vat,
        ];
    }
}
