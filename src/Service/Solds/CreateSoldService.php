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
        /** @var ArrayCollection $items */
        $items=[];
        $gains=0.0;
        $data=json_decode($request->getContent(),true);
        $sold= new Sold($data['transfer']);
        $item=new Item();
        $items=[];
        foreach ($data['products'] as $productItem)
        {
            $product= $this->productRepository->findOneByCod($productItem['codigo']);
            if($product != null)
            {
                $item->setAmount($productItem['amount']);
                $item->setProduct($product);
                $item->setPrice($product->getPriceF());
                $item->setSold($sold);

                $items[]=[
                    'product'=>$product,
                    'price'=>$product->getPriceF(),
                    'amount'=>$productItem['amount']
                ];


            }else {
                throw new \Exception(sprintf('El producto no se encontro en el sistema'));
            }
        }
        foreach ($items as $item)
        {
            $gains +=$item['price'] * $item['amount'];
            dump($item);
            $item['product']->setStock($item->getProduct()->getStock()-$item->getAmount());
            $this->productRepository->save($item->getProduct());

        }

        $sold->setAmount($gains);

        $array = new ArrayCollection($items);
        $sold->setItem($array);

        $this->itemRepository->save($item);
        $this->repository->save($sold);

        return new JsonResponse(['message'=>'Venta Exitosa'],JsonResponse::HTTP_OK);
    }
}