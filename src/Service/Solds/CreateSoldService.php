<?php


namespace App\Service\Solds;


use App\Entity\Item;
use App\Entity\Sold;
use App\Repository\ItemRepository;
use App\Repository\ProductRepository;
use App\Repository\SoldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateSoldService
{
    private SoldRepository $repository;
    private ProductRepository $productRepository;
    private ItemRepository $itemRepository;

    public function __construct(SoldRepository $repository,ProductRepository $productRepository,ItemRepository $itemRepository)
    {
        $this->repository = $repository;
        $this->productRepository = $productRepository;
        $this->itemRepository = $itemRepository;
    }

    public function __invoke(Request $request)
    {

        $items=[];
        $gains=0.0;
        $data=json_decode($request->getContent(),true);
        $sold= new Sold($data['transfer']);

        $items=[];
        foreach ($data['products'] as $productItem)
        {
            $product= $this->productRepository->findOneByCod($productItem['codigo']);
            if($product !== null)
            {
                $item=new Item();
                $item->setAmount($productItem['amount']);
                $item->setProduct($product);
                $item->setPrice($product->getPriceF());
                $item->setSold($sold);

                $items[]=$item;


            }else {
                throw new \Exception(sprintf('El producto no se encontro en el sistema'));
            }
        }
        foreach ($items as $item)
        {
            $gains +=$item->getPrice()*$item->getAmount();

            $item->getProduct()->setStock($item->getProduct()->getStock()-$item->getAmount());
            $this->productRepository->save($item->getProduct());

        }

        $sold->setAmount($gains);

        $array = new ArrayCollection($items);
        $sold->setItem($array);
        $this->repository->save($sold);



        return new JsonResponse(['message'=>$sold->toArray()],JsonResponse::HTTP_OK);
    }
}