<?php

namespace App\Service\DashBoard;

use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class CrecimientoVentasService
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke()
    {
        $response = new JsonResponse();
        $periodoActual = $this->soldRepository->calcularVentasPeriodoActual();
        $periodoAnterior = $this->soldRepository->calcularVentasPeriodoAnterior();

        $result = (($periodoActual - $periodoAnterior)/$periodoAnterior)*100;

        $response->setData([
            'succes' => true,
            'data' => $result,
        ]);
        return $response;
    }
}