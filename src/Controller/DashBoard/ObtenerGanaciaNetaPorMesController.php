<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerGananciaNetaPorDiaService;
use App\Service\DashBoard\ObtenerGananciaNetaPorMesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerGanaciaNetaPorMesController extends AbstractController
{
    public function __construct(private ObtenerGananciaNetaPorMesService $mesService)
    {
    }

    public function __invoke()
    {
        return $this->mesService->__invoke();
    }
}