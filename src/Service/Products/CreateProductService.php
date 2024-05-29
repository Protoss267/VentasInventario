<?php


namespace App\Service\Products;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;

class CreateProductService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request):Product{
        $data= json_decode($request->getContent(),true);
        $product= new Product($data['codigo'],$data['name'],$data['priceI'],$data['priceF'],$data['stock']);
        $this->repository->save($product);

        return $product;
    }
}