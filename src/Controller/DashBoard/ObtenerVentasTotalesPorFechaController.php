<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerVentasTotalesPorFechaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerVentasTotalesPorFechaController extends AbstractController
{
    public function __construct(private ObtenerVentasTotalesPorFechaService $obtenerVentasTotalesPorFechaService)
    {

    }

    public function __invoke()
    {
        return $this->obtenerVentasTotalesPorFechaService->__invoke();
    }
}