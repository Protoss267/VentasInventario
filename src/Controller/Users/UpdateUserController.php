<?php


namespace App\Controller\Users;


use App\Service\Users\UpdateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateUserController extends AbstractController
{
    private UpdateUserService $updateUserService;

    public function __construct(UpdateUserService $updateUserService)
    {
        $this->updateUserService = $updateUserService;
    }

    public function __invoke(Request $request,string $id)
    {
        $data= json_decode($request->getContent(),true);
        $user = $this->updateUserService->__invoke($id,$data['username'],$data['password'],$data['name'],$data['isAdmin']);

        return new JsonResponse([
            'id'=>$user->getId(),
            'username'=>$user->getUsername(),
            'name'=>$user->getName(),
            'password'=>$user->getPassword(),
            'isAdmin'=>$user->isAdmin(),
            'created'=>$user->getCreated(),
            'updated'=>$user->getUpdated()
        ],
        JsonResponse::HTTP_OK
        );
    }
}