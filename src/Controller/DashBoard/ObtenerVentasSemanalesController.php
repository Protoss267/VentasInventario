<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerVentasSemanalesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerVentasSemanalesController extends AbstractController
{
private ObtenerVentasSemanalesService $ventasSemanales;

public function __construct(ObtenerVentasSemanalesService $ventasSemanales)
{
    $this->ventasSemanales=$ventasSemanales;
}

public function __invoke()
{
    return $this->ventasSemanales->__invoke();
}
}