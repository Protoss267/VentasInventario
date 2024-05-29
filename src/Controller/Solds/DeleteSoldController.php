<?php


namespace App\Controller\Solds;


use App\Service\Solds\DeleteSoldService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DeleteSoldController extends AbstractController
{
    private DeleteSoldService $deleteSoldService;

    public function __construct(DeleteSoldService $deleteSoldService)
    {
        $this->deleteSoldService = $deleteSoldService;
    }

    public function __invoke(string $id,Request $request)
    {
        return $this->deleteSoldService->__invoke($id,$request);
    }
}