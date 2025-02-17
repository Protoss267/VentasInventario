<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ObtenerMargenGanaciasService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObtenerMargenGanaciaController extends AbstractController
{
    public function __construct(private ObtenerMargenGanaciasService $ganaciasService)
    {
    }

    public function __invoke()
    {
        return $this->ganaciasService->__invoke();
    }
}