<?php

namespace App\Http\Resources;

use App\Http\Services\UploadService;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {;
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'image'  => UploadService::getFullPublicUrl($this->upload?->where('background' , false)->first()->file_name , Upload::MARKET),
            'background_image' => UploadService::getFullPublicUrl($this->upload?->where('background' , true)->first()?->file_name, Upload::MARKET)
        ];
    }
}
