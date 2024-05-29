<?php


namespace App\Controller\Products;


use App\Service\Products\GetOneProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetOneProductController extends AbstractController
{
    private GetOneProductService $productService;

    public function __construct(GetOneProductService $productService)
    {
        $this->productService = $productService;
    }

    public function __invoke(string $cod,Request $request)
    {
        return $this->productService->__invoke($cod,$request);
    }
}