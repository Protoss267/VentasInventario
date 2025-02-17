<?php

namespace App\Service\DashBoard;

use App\Repository\SoldRepository;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerVentasTotalesPorSemanaYAnnoService
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke()
    {
        $response = new JsonResponse();
        $ventasAgrupadas = $this->soldRepository->getVentasUltimosSeisMesesAgrupadas();

        $ventasPorSemana = [];

        foreach ($ventasAgrupadas as $venta) {
            $fecha = DateTime::createFromFormat('Y-m-d', $venta['fecha']);
            if ($fecha) {
                $semana = $fecha->format('o-W'); // Año-Semana ISO-8601
                if (!isset($ventasPorSemana[$semana])) {
                    $ventasPorSemana[$semana] = [
                        'totalVentas' => 0,
                        'cantidadVentas' => 0
                    ];
                }
                $ventasPorSemana[$semana]['totalVentas'] += (int)$venta['totalVentas'];
                $ventasPorSemana[$semana]['cantidadVentas'] += (int)$venta['cantidadVentas'];
            }
        }

// Convertir el array asociativo a listas ordenadas
        ksort($ventasPorSemana); // Ordenar por clave (año-semana)

        $labels = array_keys($ventasPorSemana);
        $totales = array_column($ventasPorSemana, 'totalVentas');
        $cantidades = array_column($ventasPorSemana, 'cantidadVentas');

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