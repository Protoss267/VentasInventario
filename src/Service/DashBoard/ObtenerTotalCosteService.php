<?php



namespace App\Service\DashBoard;

use App\Repository\SoldRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class ObtenerTotalCosteService
{
    public function __construct(private SoldRepository $soldRepository)
    {
    }

    public function __invoke()
    {
        $response = new JsonResponse();

        $resul= $this->soldRepository->getTotalCostos();

          $response->setData([
                'success'=>true,
                'data'=>$resul
            ]);

        return $response;

    }
}





