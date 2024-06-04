<?php


namespace App\Service\Solds;


use App\Entity\Item;
use App\Repository\ItemRepository;
use App\Repository\ProductRepository;
use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteSoldService
{
    private SoldRepository $soldRepository;
    private ProductRepository $productRepository;
    private ItemRepository $itemRepository;

    public function __construct(SoldRepository $soldRepository,
                                ProductRepository $productRepository,
                                ItemRepository $itemRepository)
    {
        $this->soldRepository = $soldRepository;
        $this->productRepository = $productRepository;
        $this->itemRepository = $itemRepository;
    }

    public function __invoke(string $id, Request $request)
    {
        $sold=$this->soldRepository->findOneById($id);

        if ($sold != null)
        {
            /** @var Item $item */
            foreach ($sold->getItem() as $item)
            {
                $product= $item->getProduct();
                $product->setStock($product->getStock()+$item->getAmount());
                $this->productRepository->save($product);
                $this->itemRepository->delete($item);

            }
        }else return new JsonResponse(['message'=>'Ha ocurrido un erro'],JsonResponse::HTTP_OK);

        $this->soldRepository->delete($sold);

        return new JsonResponse(['message'=>'La venta se ha eliminado satisfactoriamente'],JsonResponse::HTTP_OK);
    }
}