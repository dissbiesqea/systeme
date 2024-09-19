<?php

namespace App\Services;

use App\Helper\CalculationHelper;
use App\Model\PurchaseResponse;
use App\Model\TargetSumResponse;
use App\Model\ValidationRequests\CalculationPriceRequest;
use App\Model\ValidationRequests\PurchaseRequest;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Services\Purchase\PurchaseFactory;

readonly class PurchaseService
{
    public function __construct(
        private ProductRepository $productRepository,
        private CouponRepository $couponRepository,
        private PurchaseFactory $purchaseFactory,
        // private PaypalPaymentProcessor $paymentProcessor
    ) {
    }

    public function calculatePrice(CalculationPriceRequest $calculationPriceRequest): TargetSumResponse
    {
        $product = $this->productRepository->find($calculationPriceRequest->getProduct());
        $coupon = $this->couponRepository->findOneBy(['code' => $calculationPriceRequest->getCouponCode()]);

        $targetSum = CalculationHelper::getCalculate(
            $product->getPrice(),
            $coupon->getType(),
            $coupon->getPercentDiscount(),
            $coupon->getFixedDiscount(),
            $calculationPriceRequest->getTaxNumber()
        );

        return new TargetSumResponse(
            $targetSum,
            $calculationPriceRequest->product,
            $calculationPriceRequest->taxNumber,
            $calculationPriceRequest->couponCode,
        );
    }

    public function purchase(PurchaseRequest $purchaseRequest): PurchaseResponse
    {
        $product = $this->productRepository->find($purchaseRequest->getProduct());
        $coupon = $this->couponRepository->findOneBy(['code' => $purchaseRequest->getCouponCode()]);

        $targetSum = CalculationHelper::getCalculate(
            $product->getPrice(),
            $coupon->getType(),
            $coupon->getPercentDiscount(),
            $coupon->getFixedDiscount(),
            $purchaseRequest->getTaxNumber()
        );

        return new PurchaseResponse($this->purchaseFactory->createPurchase($purchaseRequest->paymentProcessor)->pay($targetSum));
    }
}
