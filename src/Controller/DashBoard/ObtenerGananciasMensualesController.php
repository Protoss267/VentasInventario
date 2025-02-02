<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerGanaciasMensualesServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerGananciasMensualesController extends AbstractController
{
    private ObtenerGanaciasMensualesServices $ganaciasMensualesServices;

    public function __construct(ObtenerGanaciasMensualesServices $ganaciasMensualesServices)
    {
        $this->ganaciasMensualesServices = $ganaciasMensualesServices;
    }

    public function __invoke()
    {
        return $this->ganaciasMensualesServices->__invoke();
    }
}