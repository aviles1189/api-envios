<?php

namespace App\Controller;

use App\Service\QuoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    #[Route('/api/quote', methods: ['POST'])]
    public function quote(Request $request, QuoteService $quoteService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $result = $quoteService->getQuotes(
            $data['originZipcode'],
            $data['destinationZipcode']
        );

        return new JsonResponse($result);
    }
}