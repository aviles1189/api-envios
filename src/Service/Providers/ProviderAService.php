<?php

namespace App\Service\Providers;

use App\Service\QuoteProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProviderAService implements QuoteProviderInterface
{
    public function __construct(private HttpClientInterface $client) {}

    public function getQuote(string $origin, string $destination): array
    {
        $url = 'https://webhook.site/bfa2fb1e-16db-4bef-a479-4b2ca41c6dd6';

        $response = $this->client->request('POST', $url, [
            'headers' => [
                'User-Agent' => 'SymfonyHttpClient',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'body' => json_encode([
                'originZipcode' => $origin,
                'destinationZipcode' => $destination
            ])
        ]);
        
        return [
            'provider' => 'ProviderA',
            'success' => true,
            'data' => $response->toArray()
        ];
    }
}
