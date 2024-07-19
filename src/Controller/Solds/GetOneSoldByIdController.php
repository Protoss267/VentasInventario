<?php


namespace App\Controller\Solds;


use App\Service\Solds\GetOneSoldByIdService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetOneSoldByIdController extends AbstractController
{
    public function __construct(private GetOneSoldByIdService $getOneSoldByIdService)
    {
    }

    public function __invoke(string $id)
    {
        return $this->getOneSoldByIdService->__invoke($id);
    }
}