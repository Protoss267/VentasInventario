<?php


namespace App\Service\Solds;


use App\Entity\Sold;
use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetSoldsByDayService
{
    private SoldRepository $soldRepository;

    public function __construct(SoldRepository $soldRepository){
        $this->soldRepository = $soldRepository;
    }

    public function __invoke()
    {
        $data=[];
        $response = new JsonResponse();
        $total=0;

        $solds=$this->soldRepository->getSoldByDay();

        /** @var Sold $sold */
        foreach($solds as $sold)
        {
            $data[]=[
                'sold'=>$sold->toArray()
            ];
            $total+= $sold->getAmount();
        }




        $response->setData([
            'success'=> true,
            'data'=>$data,

        ]);

        return $response;

    }
}