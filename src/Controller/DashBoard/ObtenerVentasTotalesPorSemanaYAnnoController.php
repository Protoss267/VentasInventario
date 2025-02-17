<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerVentasTotalesPorSemanaYAnnoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerVentasTotalesPorSemanaYAnnoController extends AbstractController
{
    public function __construct(private ObtenerVentasTotalesPorSemanaYAnnoService $obtenerVentasTotalesPorSemanaYAnnoService)
    {
    }

    public function __invoke()
    {
        return $this->obtenerVentasTotalesPorSemanaYAnnoService->__invoke();
    }
}