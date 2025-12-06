<?php

namespace App\Service\Providers;

use App\Service\QuoteProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProviderAService implements QuoteProviderInterface
{
    public function __construct(private HttpClientInterface $client) {}

    public function supports(string $providerName): bool
    {
        return $providerName === 'ProviderA';
    }

    public function getQuote(string $origin, string $destination, string $endpoint): array
    {
        $response = $this->client->request('POST', $endpoint, [
            'json' => [
                'originZipcode' => $origin,
                'destinationZipcode' => $destination
            ]
        ]);

        return [
            'provider' => 'ProviderA',
            'success' => true,
            'data' => $response->getContent(false)
        ];
    }
}