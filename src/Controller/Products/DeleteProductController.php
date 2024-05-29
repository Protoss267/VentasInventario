<?php


namespace App\Controller\Products;


use App\Service\Products\DeleteProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DeleteProductController extends AbstractController
{
    private DeleteProductService $productService;

    public function __construct(DeleteProductService $productService)
    {
        $this->productService = $productService;
    }

    public function __invoke(string $id,Request $request)
    {
        return $this->productService->__invoke($id,$request);
    }
}