<?php


namespace App\Controller\Products;


use App\Service\Products\CreateProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateProductController extends AbstractController
{
    private CreateProductService $createProductService;

    public function __construct(CreateProductService $createProductService)
    {
        $this->createProductService = $createProductService;
    }

    public function __invoke(Request $request):JsonResponse
    {
        $data=[];
        $response = new JsonResponse();
        $product=$this->createProductService->__invoke($request);

        $data=[
            'id'=>$product->getId(),
            'codigo'=>$product->getCodigo(),
            'name'=>$product->getName(),
            'priceI'=>$product->getPriceI(),
            'priceF'=>$product->getPriceF(),
            'stock'=>$product->getStock(),
            'created'=>$product->getDateIn(),
            'updated'=>$product->getDateUpdated(),
        ];
        $response->setData([
            'success'=>true,
            'data'=>$data
        ]);

        return $response;
    }
}