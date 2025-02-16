<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\CrecimientoVentasService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CrecimientoVentasController extends AbstractController
{
    public function __construct(private CrecimientoVentasService $crecimientoVentas)
    {
    }

    public function __invoke()
    {
        return $this->crecimientoVentas->__invoke();
    }
}