<?php


namespace App\Service\Products;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductsLowStockService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke()
    {
        $products = $this->productRepository->GetLowStock();
        $data=[];
        $response = new JsonResponse();

        if($products != null){
        /** @var Product $product */
        foreach ($products as $product)
        {
            $data[]= $product->toArray();
        }

        $response->setData(['success'=>true,'data'=>$data]);
        }
        else
        {
            $data[]=[
                'success'=>false,
                'message'=>'No existen productos con baja existencia'
            ];
            $response->setData($data);
        }

        return $response;
    }
}