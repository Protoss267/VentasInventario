<?php

namespace App\Service\DashBoard;

use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerGananciaNetaPorSemanaService
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke()
    {
        $response = new JsonResponse();

        $resul = $this->soldRepository->getGananciaNetaPorSemana();

        $response->setData([
            'success'=>true,
            'data'=>$resul
        ]);

        return $response;
    }
}