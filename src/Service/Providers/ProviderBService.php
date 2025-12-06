<?php

namespace App\Service\Providers;

use App\Service\QuoteProviderInterface; 
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProviderBService implements QuoteProviderInterface
{
    public function __construct(private HttpClientInterface $client) {}

    public function getQuote(string $origin, string $destination): array
    {
        try {
            $response = $this->client->request('POST', 'https://webhook.site/bfa2fb1e-16db-4bef-a479-4b2ca41c6dd6', [
                'headers' => [
                    'User-Agent' => 'SymfonyHttpClient',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => [
                    'originZipcode' => $origin,
                    'destinationZipcode' => $destination
                ]
            ]);

            return [
                'provider' => 'ProviderB',
                'success' => false,
                'error' => 'Simulated error',
            ];
        } catch (\Exception $e) {
            return [
                'provider' => 'ProviderB',
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}