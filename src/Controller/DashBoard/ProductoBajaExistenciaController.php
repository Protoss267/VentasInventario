<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ProductoBajaExistenciaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductoBajaExistenciaController extends AbstractController
{
    public function __construct(private ProductoBajaExistenciaService $bajaExistenciaService)
    {
    }

    public function __invoke(int $umbral)
    {
       return $this->bajaExistenciaService->__invoke($umbral);
    }
}