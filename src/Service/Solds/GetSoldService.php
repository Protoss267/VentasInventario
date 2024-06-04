<?php


namespace App\Service\Solds;


use App\Entity\Product;
use App\Entity\Sold;
use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetSoldService
{
    private SoldRepository $soldRepository;

    public function __construct(SoldRepository $soldRepository){
        $this->soldRepository = $soldRepository;
    }

    public function __invoke():JsonResponse
    {
        $solds=$this->soldRepository->findAll();
        $data=[];
        $response = new JsonResponse();

        /** @var Sold $sold */
        foreach ($solds as $sold)
        {
            $data[]=[
                $sold->toArray()
            ];
        }


        $response->setData([
            'success'=>true,
            'data'=>$data
        ]);

        return $response;
    }
}