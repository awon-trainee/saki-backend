<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = $this->user->categories->first();
        return [
            'balance' => convertToSar($this->balance->amount),
            'category_name' => $category->name,
            'category_id' => $category->id,
            'market' => MarketResource::collection($category->activeMarket()->get())
        ];
    }
}
