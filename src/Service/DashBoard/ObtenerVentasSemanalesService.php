<?php

namespace App\Service\DashBoard;

use App\Entity\Sold;
use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerVentasSemanalesService
{
    private SoldRepository $soldRepository;

    public function __construct(SoldRepository $soldRepository)
    {
        $this->soldRepository=$soldRepository;
    }

    public function __invoke()
    {

        $response = new JsonResponse();
        $solds = $this->soldRepository->getSoldByWeek();



        $response->setData([
            'success'=>true,
            'data'=>$solds
            ]);

        return $response;
    }
}