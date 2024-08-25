<?php

namespace App\Http\Resources;

use App\Http\Services\BarcodeService;
use App\Http\Services\UploadService;
use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $barcodeService = new BarcodeService();
        return [
            'id' => $this->id,
            'image' => UploadService::getFullPublicUrl($this->item->resalProduct->market->upload?->where('background', false)->first()->file_name, Upload::MARKET),
            'status' => $this->status,
            'amount' => convertToSar($this->amount),
            'market_name' => $this->item->resalProduct->market->name,
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'barcode_link' => $barcodeService->link($this->code),
        ];
    }
}
