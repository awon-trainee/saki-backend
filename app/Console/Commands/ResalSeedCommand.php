<?php

namespace App\Console\Commands;

use App\Http\Services\ResalService;
use App\Models\ResalProduct;
use Illuminate\Console\Command;

/**
 * This command seeds the local database with products and variants from Resal API.
 */
class ResalSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resal:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ResalService $resalService)
    {
        $this->info('Client created successfully, access token: ' . ResalService::$accessToken . ', expires in: ' . ResalService::$expiresIn);
        $this->info('Balance: ' . $resalService->balance());
        $this->info('Updating...');
        $resalService->updateLocalDb();
        $this->info('Done Updating');
    }
}
