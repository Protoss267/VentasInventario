<?php

namespace App\Service\DashBoard;

use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerGananciaNetaPorDiaService
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke()
    {
        $response = new JsonResponse();

        $resul = $this->soldRepository->getGananciaNetaPorDia();

        $response->setData([
            'success'=>true,
            'data'=>$resul
        ]);

        return $response;
    }
}