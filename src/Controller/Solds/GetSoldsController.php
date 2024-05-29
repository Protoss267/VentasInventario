<?php


namespace App\Controller\Solds;


use App\Service\Solds\GetSoldService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetSoldsController extends AbstractController
{
    private GetSoldService $getSoldService;

    public function __construct(GetSoldService $getSoldService)
    {
        $this->getSoldService = $getSoldService;
    }

    public function __invoke()
    {
        return $this->getSoldService->__invoke();
    }
}