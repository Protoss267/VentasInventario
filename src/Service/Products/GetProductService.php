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
            $data[]=[
              'id'=>$product->getId(),
              'codigo'=>$product->getCodigo(),
              'name'=>$product->getName(),
              'priceI'=>$product->getPriceI(),
              'priceF'=>$product->getPriceF(),
              'stock'=>$product->getStock(),
              'created'=>$product->getDateIn(),
              'updated'=>$product->getDateUpdated(),
            ];
        }

        $response->setData([
            'success'=>true,
            'data'=>$data
        ]);

        return $response;

    }
}