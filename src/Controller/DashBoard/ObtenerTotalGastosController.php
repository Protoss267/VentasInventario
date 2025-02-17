<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerTotalCosteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerTotalGastosController extends AbstractController
{
    public function __construct(private ObtenerTotalCosteService $costeService)
    {
    }

    public function __invoke()
    {
        return $this->costeService->__invoke();
    }
}