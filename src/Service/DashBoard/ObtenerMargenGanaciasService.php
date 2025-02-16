<?php

namespace App\Service\DashBoard;

use Symfony\Component\HttpFoundation\JsonResponse;

class ObtenerMargenGanaciasService
{
    public function __construct(private ObtenerTotalIngresosService $ingresosService,
                                private ObtenerGanaciaNetaService   $ganaciaNetaService)
    {
    }

    public function __invoke()
    {
        $response = new JsonResponse();
        $ganancia = json_decode($this->ganaciaNetaService->__invoke()->getContent(),true);
        $ingresos = json_decode($this->ingresosService->__invoke()->getContent(),true);

        $resul = ($ganancia['data']/$ingresos['data'])*100;
        $response->setData([
            'success' => true,
            'data' => $resul,
        ]);
        return $response;
    }
}