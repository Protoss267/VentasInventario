<?php


namespace App\Controller\Users;


use App\Service\Users\CreateUserServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateUserController extends AbstractController
{
    private CreateUserServices $userServices;

    public function __construct(CreateUserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function __invoke(Request $request)
    {
        $data=json_decode($request->getContent(),true);
        $user=$this->userServices->__invoke($data['username'],$data['password'],$data['name'],$data['isAdmin']);

        return new JsonResponse([
            'id'=>$user->getId(),
            'name'=>$user->getName(),
            'username'=>$user->getUsername(),
            'password'=>$user->getPassword(),
            'isAdmin'=>$user->isAdmin(),
            'created'=>$user->getCreated(),
            'updated'=>$user->getUpdated()
        ],
            JsonResponse::HTTP_CREATED
        );
    }
}