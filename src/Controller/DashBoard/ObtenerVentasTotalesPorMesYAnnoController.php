<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerVentasTotalesPorMesYAnnoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerVentasTotalesPorMesYAnnoController extends AbstractController
{
    public function __construct(private ObtenerVentasTotalesPorMesYAnnoService $annoService)
    {
    }

    public function __invoke()
    {
        $resul= $this->annoService->__invoke();
        return new JsonResponse([
            'success'=>true,
            'data'=>$resul
        ]);
    }
}