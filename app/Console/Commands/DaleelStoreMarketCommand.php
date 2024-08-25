<?php

namespace App\Console\Commands;

use App\Enums\MarketStatus;
use App\Http\Services\DaleelStoreService;
use App\Models\DaleelStoreMarket;
use App\Models\Market;
use Illuminate\Console\Command;

class DaleelStoreMarketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daleel:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will fetch all markets from daleel store and store it in database';

    /**
     * Execute the console command.
     */
    public function handle(DaleelStoreService $daleelStoreService)
    {
        $jsonData = $daleelStoreService->request('post', DaleelStoreService::GET_ITEM);
        $markets = collect($jsonData['items'])->map(function($item) {
            return [
                'daleel_store_id' => $item['id'],
                'product' => $item['product'],
                'category' => $item['product'],
                'store' => $item['store'],
                'amount' => $item['amount'],
                'description' => $item['description'] ?? null,
                'price' => convertToHallal($item['price']),
                'has_vat' => $item['has_vat'],
                'status' => MarketStatus::IN_ACTIVE
            ];
        })->toArray();

        foreach ($markets as $market) {
            if(DaleelStoreMarket::query()->where('daleel_store_id' , $market['daleel_store_id'])->exists()) {
                $this->info("market {$market['daleel_store_id']} Already Exists");
                continue;
            }
            DaleelStoreMarket::query()->create($market);
            $this->info("added market {$market['daleel_store_id']} Successfully");
        }
    }
}
