<?php

namespace App\Http\Services;

use App\Models\ResalProduct;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class ResalService
{
    private Client $client;
    private string $apiUrl = 'https://channels-api-stage.myresal.com/';

    // TODO: make it private
    public static string $accessToken;
    public static Carbon $expiresIn;
    public static Carbon $lastUpdate;

    const ROUTE_TOKEN = 'client_credentials/token';

    public function __construct()
    {
        $this->client = new Client([
            RequestOptions::VERIFY => false,
        ]);

        if (empty(self::$accessToken) || self::$expiresIn->isPast()) {
            $this->auth();
        }
    }

    private function auth(): void
    {
        $credentials = base64_encode(config('app.resal.username') . ':' . config('app.resal.password'));

        $response = $this->client->post($this->apiUrl . self::ROUTE_TOKEN, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => ['Basic ' . $credentials],
            ],
        ]);

        $response = json_decode($response->getBody()->getContents());

        // 10 seconds before expiration (to be safe)
        self::$expiresIn = Carbon::now()->addSeconds($response->expires_in - 10);
        self::$accessToken = $response->access_token;
    }


    private function request($method, $path, $data = null): object
    {
        $response = $this->client->$method($this->apiUrl . $path, [
            'headers' => [
                'auth-type' => 'oauth2_client_credentials',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . self::$accessToken,
            ],
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function balance(): float
    {
        return $this->request('get', 'balance')->wallet->balance;
    }

    public function products($page = 1, $perPage = 10, $locale = 'ar'): object
    {
        $path = 'e-gift-products?page=' . $page . '&per_page=' . $perPage . '&locale=' . $locale;
        return $this->request('get', $path);
    }

    public function quickOrder($variantId, $receiverName = null, $locale = 'ar')
    {
        $path = 'quick-orders?locale=' . $locale;
        return $this->request('post', $path, [
            'gift_product_variants' => [
                [
                    'id' => $variantId,
                    'quantity' => 1
                ],
            ],
            'receiver_name' => $receiverName,
            'sender_name' => 'AwonTech'
        ]);
    }

    public function updateLocalDb(): void
    {
        self::$lastUpdate = Carbon::now();
        $page = 1;
        $lastPage = 1;
        while ($page <= $lastPage) {
            $response = $this->products($page);
            $lastPage = $response->meta->last_page;
            foreach ($response->data as $data) {
                $product = ResalProduct::query()->updateOrCreate(
                    ['id' => $data->id],
                    [
                        'title' => $data->title,
                        'photo' => $data->photo,
                        'description' => $data->description,
                        'begin_price' => $data->begin_price,
                        'display' => $data->display,
                    ]
                );
                foreach ($data->variants as $variant) {
                    $country = strtolower($variant->country->code);
                    // Skip countries other than Saudi Arabia
                    if (!in_array($country, ['sa', 'all'])) {
                        continue;
                    }
                    $product->resalVariants()->updateOrCreate(
                        ['id' => $variant->id],
                        [
                            'value' => $variant->value,
                            'price_with_vat' => $variant->price_with_vat,
                            'display' => $variant->display,
                            'barcode' => $variant->barcode,
                            'quantity' => $variant->stock->quantity,
                        ]
                    );
                }
            }
            $page++;
        }
    }
}
