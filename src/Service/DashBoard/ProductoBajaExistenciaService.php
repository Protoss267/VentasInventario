<?php

namespace App\Service\DashBoard;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductoBajaExistenciaService
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(int $umbral)
    {
        $data=[];
        $response = new JsonResponse();

        $resul= $this->productRepository->GetLowStock($umbral);

        /** @var Product $producto */
        foreach ($resul as $producto)
        {
            $data[]=[
                'Nombre'=>$producto->getName(),
                'existencia'=>$producto->getStock()
            ];
        }
        $response->setData([
            'success'=>true,
            'data'=>$data
        ]);

        return $response;
    }
}