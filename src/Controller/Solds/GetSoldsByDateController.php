<?php


namespace App\Controller\Solds;


use App\Service\Solds\GetSoldsByDateService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetSoldsByDateController extends AbstractController
{


    public function __construct(private GetSoldsByDateService $getSoldsByDateService)
    {

    }

    public function __invoke(Request $request)
    {
        $data= json_decode($request->getContent(),true);
        $fechaI= new \DateTime($data['fechaI']);
        $fechaF= new \DateTime(($data['fechaF']));
        return $this->getSoldsByDateService->__invoke($fechaI,$fechaF);
    }
}