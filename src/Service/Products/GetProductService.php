<?php


namespace App\Service\Products;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $products= $this->repository->findAllProduct();
        $data=[];
        $response = new JsonResponse();

        /** @var Product $product */
        foreach ($products as $product){
            $data[]=
              $product->toArray();

        }

        $response->setData([
            'success'=>true,
            'data'=>$data
        ]);

        return $response;

    }
}