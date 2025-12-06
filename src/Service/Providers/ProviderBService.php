<?php

namespace App\Service\Providers;

use App\Service\QuoteProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProviderBService implements QuoteProviderInterface
{
    public function __construct(private HttpClientInterface $client) {}

    public function supports(string $providerName): bool
    {
        return $providerName === 'ProviderB';
    }

    public function getQuote(string $origin, string $destination, string $endpoint): array
    {
        try {
            $response = $this->client->request('POST', $endpoint, [
                'json' => [
                    'originZipcode' => $origin,
                    'destinationZipcode' => $destination
                ]
            ]);

            return [
                'provider' => 'ProviderB',
                'success' => true,
                'data' => $response->getContent(false)
            ];
        } catch (\Throwable $e) {
            return [
                'provider' => 'ProviderB',
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}