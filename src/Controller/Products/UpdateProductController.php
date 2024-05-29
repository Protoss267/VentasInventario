<?php


namespace App\Controller\Products;


use App\Service\Products\UpdateProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateProductController extends AbstractController
{
    private UpdateProductService $productService;

    public function __construct(UpdateProductService $productService)
    {
        $this->productService = $productService;
    }

    public function __invoke(string $id,Request $request):JsonResponse
    {
        return $this->productService->__invoke($id,$request);
    }
}