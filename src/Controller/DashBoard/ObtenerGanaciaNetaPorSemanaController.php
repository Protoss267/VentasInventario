<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerGananciaNetaPorDiaService;
use App\Service\DashBoard\ObtenerGananciaNetaPorSemanaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerGanaciaNetaPorSemanaController extends AbstractController
{
    public function __construct(private ObtenerGananciaNetaPorSemanaService $netaPorSemanaService)
    {
    }

    public function __invoke()
    {
        return $this->netaPorSemanaService->__invoke();
    }
}