<?php

namespace App\Controller\DashBoard;

use App\Service\DashBoard\ProductosVendidosPorMesServices;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductoVendidoPorMesController extends AbstractController
{
    public function __construct(private ProductosVendidosPorMesServices $mesServices)
    {
    }
    public function __invoke(Request $request): JsonResponse
    {
        $mes = (int) $request->query->get('mes');
        $anno = (int) $request->query->get('anno');

        if (!$mes || !$anno) {
            return new JsonResponse(['success' => false, 'message' => 'Mes y año son requeridos'], 400);
        }

        $ventas = $this->mesServices->__invoke($mes, $anno);

        return new JsonResponse([
            'success' => true,
            'data' => $ventas
        ]);
    }
}