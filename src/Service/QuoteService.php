<?php

namespace App\Service;

use App\Repository\ProviderRepository;

class QuoteService
{
    public function __construct(
    	private ProviderRepository $providerRepository,
        private iterable $providers
    ) {}

    public function getQuotes(string $origin, string $destination): array
    {
        $activeProviders = $this->providerRepository->findBy(['active' => true]);

        $results = [];

        foreach ($activeProviders as $providerEntity) {
            $providerName = $providerEntity->getName();
            $endpoint = $providerEntity->getEndpoint();

            // buscar el servicio correspondiente
            foreach ($this->providers as $service) {
                if ($service->supports($providerName)) {
                    $results[] = $service->getQuote($origin, $destination, $endpoint);
                }
            }
        }

        return $results;
    }
}