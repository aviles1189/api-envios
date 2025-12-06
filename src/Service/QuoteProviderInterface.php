<?php

namespace App\Service;

interface QuoteProviderInterface
{	
	public function supports(string $providerName): bool;

    public function getQuote(string $origin, string $destination, string $endpoint): array;
}