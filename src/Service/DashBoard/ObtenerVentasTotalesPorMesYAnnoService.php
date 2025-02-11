<?php

namespace App\Service\DashBoard;

use App\Repository\SoldRepository;

class ObtenerVentasTotalesPorMesYAnnoService
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke()
    {
        $ventas = $this->soldRepository->getVentasAgrupadasPorMes();
        $labels = [];
        $totales = [];
        $cantidades = [];

        foreach ($ventas as $venta) {
            $fecha = $venta['year'] . '-' . str_pad($venta['month'], 2, '0', STR_PAD_LEFT); // YYYY-MM
            $labels[] = $fecha;
            $totales[] = $venta['totalVentas'];
            $cantidades[] = $venta['cantidadVentas'];
        }

        return [
            'labels' => $labels,
            'totales' => $totales,
            'cantidades' => $cantidades
        ];
    }
}