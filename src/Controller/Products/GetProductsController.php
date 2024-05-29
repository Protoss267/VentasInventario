<?php


namespace App\Controller\Products;


use App\Service\Products\GetProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductsController extends AbstractController
{
    private GetProductService $getProductService;

    public function __construct(GetProductService $getProductService)
    {
        $this->getProductService = $getProductService;
    }

    public function __invoke():JsonResponse{
        return $this->getProductService->__invoke();
    }
}