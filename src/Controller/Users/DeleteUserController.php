<?php


namespace App\Controller\Users;


use App\Service\Users\DeleteUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteUserController extends AbstractController
{
    private DeleteUserService $deleteUserService;

    public function __construct(DeleteUserService $deleteUserService){

        $this->deleteUserService = $deleteUserService;
    }

    public function __invoke(string $id)
    {
        return new JsonResponse([$this->deleteUserService->__invoke($id)],JsonResponse::HTTP_OK);
    }
}