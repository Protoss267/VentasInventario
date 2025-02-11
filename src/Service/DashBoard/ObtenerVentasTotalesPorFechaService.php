<?php

namespace App\Service\DashBoard;

use App\Entity\Sold;
use App\Repository\SoldRepository;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerVentasTotalesPorFechaService
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke()
    {
        $ventas = $this->soldRepository->findAllOrderedByDate();
        $response = new JsonResponse();
        $ventasAgrupadas = [];

        $fechaLimite = (new \DateTime())->modify('-3 months');

        foreach ($ventas as $venta) {
            $fechaVenta = $venta->getDate();

            if ($fechaVenta >= $fechaLimite) { // Filtrar solo las ventas dentro del rango de 3 meses
                $fecha = $fechaVenta->format('Y-m-d');

                if (!isset($ventasAgrupadas[$fecha])) {
                    $ventasAgrupadas[$fecha] = [
                        'totalVentas' => 0,
                        'cantidadVentas' => 0
                    ];
                }

                $ventasAgrupadas[$fecha]['cantidadVentas']++;
                $ventasAgrupadas[$fecha]['totalVentas'] += (int) $venta->getAmount();
            }
        }

        $labels = array_keys($ventasAgrupadas);
        $totales = array_column($ventasAgrupadas, 'totalVentas');
        $cantidades = array_column($ventasAgrupadas, 'cantidadVentas');

        $resul = [
            'labels' => $labels,
            'totales' => $totales,
            'cantidades' => $cantidades
        ];

        $response->setData([
            'success' => true,
            'data' => $resul
        ]);

        return $response;
    }
}