<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerTotalIngresosService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerTotalIngresosController extends AbstractController
{
    public function __construct(private ObtenerTotalIngresosService $ingresosService)
    {
    }
    public function __invoke()
    {
        return $this->ingresosService->__invoke();
    }
}