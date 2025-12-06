<?php

namespace App\Service;

interface QuoteProviderInterface
{
    public function getQuote(string $origin, string $destination): array;
}