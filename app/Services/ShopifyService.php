<?php
namespace App\Services;

use GuzzleHttp\Client;

class ShopifyService
{
    private $client;
    private $apiKey;
    private $apiPassword;
    private $storeName;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('SHOPIFY_API_KEY');
        $this->apiPassword = env('SHOPIFY_API_PASSWORD');
        $this->storeName = env('SHOPIFY_STORE_NAME');
    }

    public function createProduct($productData)
    {
        $url = "https://myshop-2487.myshopify.com/admin/api/2024-07/products.json";
        $headers = [
            'Authorization' => "Basic " . base64_encode("{$this->apiKey}:{$this->apiPassword}"),
            'Content-Type' => 'application/json',
        ];
        $response = $this->client->post($url, ['headers' => $headers, 'json' => $productData]);

        if ($response->getStatusCode() === 201) {
            return json_decode($response->getBody()->getContents(), true);
        }

        throw new \Exception("Error creating product: " . $response->getReasonPhrase());
    }
}
