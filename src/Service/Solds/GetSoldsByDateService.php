<?php


namespace App\Service\Solds;


use App\Entity\Item;
use App\Entity\Product;
use App\Entity\Sold;
use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetSoldsByDateService
{
    private SoldRepository $soldRepository;

    public function __construct(SoldRepository $soldRepository){
        $this->soldRepository = $soldRepository;
    }

    public function __invoke( $fechaI, $fechaF)
    {
        $data=[];
        $response = new JsonResponse();
        $total=0;
        $coste=0;
        $ganancia=0;

        $solds=$this->soldRepository->getSoldByDateRange($fechaI,$fechaF);

        /** @var Sold $sold */
        foreach($solds as $sold)
        {
            $data[]=[
                'sold'=>$sold->toArray()
            ];
            $total+= $sold->getAmount();
            /** @var Item $product */
            foreach ($sold->getItem() as $product)
            {
                $coste+=$product->getProduct()->getPriceI()*$product->getAmount();
            }
        }

        $ganancia=$total-$coste;




        $response->setData([
            'success'=> true,
            'data'=>$data,
            'total'=>$total,
            'coste'=>$coste,
            'ganancia'=>$ganancia

        ]);

        return $response;

    }
}