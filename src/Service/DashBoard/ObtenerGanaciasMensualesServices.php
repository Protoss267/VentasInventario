<?php

namespace App\Service\DashBoard;

use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerGanaciasMensualesServices
{
    private SoldRepository $soldRepository;

    public function __construct(SoldRepository $soldRepository)
    {
        $this->soldRepository= $soldRepository;
    }

    public function __invoke()
    {
        $response = new JsonResponse();
        $res=$this->soldRepository->obtenerGanaciasMensuales();
        $response->setData([
            'success'=>true,
            'data'=>$res
        ]);
        return $response;
    }
}