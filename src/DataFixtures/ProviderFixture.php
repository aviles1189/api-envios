<?php

namespace App\DataFixtures;

use App\Entity\Provider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProviderFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $providers = [
            [
                'name' => 'ProviderA',
                'endpoint' => 'https://webhook.site/bfa2fb1e-16db-4bef-a479-4b2ca41c6dd6',
            ],
            [
                'name' => 'ProviderB',
                'endpoint' => 'https://webhook.site/200-error-simulado',
            ],
        ];

        foreach ($providers as $p) {
            $provider = new Provider();
            $provider->setName($p['name']);
            $provider->setEndpoint($p['endpoint']);
            $provider->setActive(true); // si tienes el campo active

            $manager->persist($provider);
        }

        $manager->flush();
    }
}
