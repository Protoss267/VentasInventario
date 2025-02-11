<?php

namespace App\Service\DashBoard;

use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductosVendidosPorMesServices
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke(int $mes, int $anno): array
    {
        return $this->soldRepository->obtenerVentasPorMes($mes, $anno);
    }
}