<?php


namespace App\Controller\Solds;


use App\Service\Solds\CreateSoldService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CreateSoldController extends AbstractController
{
    private CreateSoldService $createSoldService;

    public function __construct(CreateSoldService $createSoldService)
    {
        $this->createSoldService = $createSoldService;
    }

    public function __invoke(Request $request)
    {
        return $this->createSoldService->__invoke($request);
    }
}