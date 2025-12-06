<?php

namespace App\Service;

class QuoteService
{
    public function __construct(
        private iterable $providers
    ) {}

    public function getQuotes(string $origin, string $destination): array
    {
        $results = [];

        foreach ($providers = $this->providers as $provider) {
            $results[] = $provider->getQuote($origin, $destination);
        }

        return $results;
    }
}