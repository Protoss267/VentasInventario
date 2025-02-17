<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerGananciaNetaPorDiaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerGanaciaNetaPorDiaController extends AbstractController
{
    public function __construct(private ObtenerGananciaNetaPorDiaService $diaService)
    {
    }

    public function __invoke()
    {
        return $this->diaService->__invoke();
    }
}