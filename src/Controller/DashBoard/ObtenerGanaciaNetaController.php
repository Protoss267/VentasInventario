<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerGanaciaNetaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerGanaciaNetaController extends AbstractController
{
    public function __construct(private ObtenerGanaciaNetaService $ganaciaNetaService)
    {
    }

    public function __invoke()
    {
        return $this->ganaciaNetaService->__invoke();
    }
}