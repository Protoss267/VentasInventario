<?php


namespace App\Service\Products;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateProductService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id,Request $request):JsonResponse
    {
        $product = $this->repository->findOneById($id);
        $data=[];
        $result=json_decode($request->getContent(),true);
        $response= new JsonResponse();

        if ($product != null){
            $product->setCodigo($result['codigo']);
            $product->setName($result['name']);
            $product->setPriceI($result['priceI']);
            $product->setPriceF($result['priceF']);
            $product->setStock($result['stock']);
            $this->repository->save($product);

            $data=[
                $product->toArray()
            ];

            $response->setData([
                'success'=>true,
                'data'=>$data
            ]);

            return $response;
        }
        else
        {
            $response->setData([
                'success'=>true,
                'data'=>'El producto no existe'
            ]);
            return $response;
        }

    }
}