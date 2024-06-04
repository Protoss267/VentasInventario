<?php


namespace App\Controller\Products;


use App\Service\Products\ProductsLowStockService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetProductsLowStockController extends AbstractController
{
    private ProductsLowStockService $lowStockService;

    public function __construct(ProductsLowStockService $lowStockService)
    {
        $this->lowStockService = $lowStockService;
    }

    public function __invoke()
    {
        return $this->lowStockService->__invoke();
    }
}