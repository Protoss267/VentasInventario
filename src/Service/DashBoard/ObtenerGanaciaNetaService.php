<?php

namespace App\Service\DashBoard;

use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerGanaciaNetaService
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke()
    {
        $response = new JsonResponse();
        $coste = $this->soldRepository->getTotalCostos();
        $ingresos = $this->soldRepository->getTotalIngresos();

        $ganaciaNeta= $ingresos-$coste;

        $response->setData([
            'success'=>true,
            'data'=>$ganaciaNeta
        ]);

        return $response;
    }
}