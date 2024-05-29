<?php


namespace App\Service\Products;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(string $id,Request $request)
    {
        $product=$this->productRepository->findOneById($id);

        if ($product != null)
        {
            $this->productRepository->delete($product);

            return new JsonResponse(['message'=>'El producto fue eliminado satisfactoriamente'],JsonResponse::HTTP_OK);
        }
        else
            return new JsonResponse(['message'=>'Ha ocurrido un error'],JsonResponse::HTTP_OK);
    }
}