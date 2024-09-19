<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\PurchaseResponse;
use App\Model\TargetSumResponse;
use App\Model\ValidationRequests\CalculationPriceRequest;
use App\Model\ValidationRequests\PurchaseRequest;
use App\Services\PurchaseService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PurchaseController extends AbstractController
{
    public function __construct(
        private readonly PurchaseService $purchaseService,
    ) {
    }

    #[Route('/calculate-price', name: 'calculate-price', methods: ['POST'])]
    #[OA\RequestBody(
        content: new Model(type: CalculationPriceRequest::class)
    )]
    #[OA\Response(
        response: 200,
        description: 'Get calculate price',
        content: new Model(type: TargetSumResponse::class)
    )]
    #[OA\Tag(name: 'purchase')]
    public function articlesByCategory(#[RequestBody] CalculationPriceRequest $calculationPriceRequest): Response
    {
        return $this->json($this->purchaseService->calculatePrice($calculationPriceRequest));
    }

    #[Route('/purchase', name: 'purchase', methods: ['POST'])]
    #[OA\RequestBody(
        content: new Model(type: PurchaseRequest::class)
    )]
    #[OA\Response(
        response: 200,
        description: 'Purchase',
        content: new Model(type: PurchaseResponse::class)
    )]
    #[OA\Tag(name: 'purchase')]
    public function purchase(#[RequestBody] PurchaseRequest $purchaseRequest): Response
    {
        return $this->json($this->purchaseService->purchase($purchaseRequest));
    }
}
