<?php


namespace App\Service\Products;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetOneProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(string $codigo,Request $request)
    {
        $data=[];
        $response= new JsonResponse();
        $product= $this->productRepository->findOneByCod($codigo);

        if($product != null)
        {
            $data=[
                $product->toArray()
            ];

            $response->setData([
                'success'=>true,
                'data'=>$data
            ]);

            return $response;
        }
        else {
            $response->setData([
                'success' => false,
                'data' => 'El producto no se encuentra en el sistema'
            ]);
            return $response;
        }
    }
}