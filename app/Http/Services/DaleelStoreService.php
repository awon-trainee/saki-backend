<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class DaleelStoreService
{

    private $apiUrl = 'https://daleelapi.com/api/v1/';
    private $accessToken;

    /*
     * Path
     */
    const GET_BALANCE = 'get_balance';
    const GET_ITEM = 'get_items';

    const PURCHASE = 'purchase';

    const OAUTH_TOKEN = 'oauth/token';

    public function __construct()
    {
        $options = [
            RequestOptions::JSON => [
                'grant_type' => config('app.daleelStore.GrantType'),
                'client_id' => config('app.daleelStore.ClientId'),
                'client_secret' => config('app.daleelStore.ClientSecret'),
                'username' => config('app.daleelStore.username'),
                'password' => config('app.daleelStore.password'),
            ],
        ];

        $client = new Client();

        $response = $client->post($this->apiUrl.self::OAUTH_TOKEN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $options[RequestOptions::JSON],
        ]);

        $this->accessToken = json_decode($response->getBody()->getContents())->access_token;
    }


    public function request($method, $path, $data = null)
    {
        $response = \Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->$method($this->apiUrl . $path, $data);

        return ($response->json());
    }
}
