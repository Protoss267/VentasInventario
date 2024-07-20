<?php


namespace App\Controller\Solds;


use App\Service\Solds\GetSoldsByDayService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetSoldsByDayController extends AbstractController
{
    private GetSoldsByDayService $getSoldsByDayService;

    public function __construct(GetSoldsByDayService $getSoldsByDayService)
    {
        $this->getSoldsByDayService = $getSoldsByDayService;
    }

    public function __invoke()
    {
        return $this->getSoldsByDayService->__invoke();
    }
}