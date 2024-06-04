<?php


namespace App\Service\Users;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUserServices
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke():JsonResponse
    {
        $data=[];
        $response = new JsonResponse();
        $users=$this->userRepository->findAllUsers();
        if ($users!=null){
            foreach ($users as $user){
                $data[]=[
                    'id'=>$user->getId(),
                    'username'=>$user->getUsername(),
                    'name'=>$user->getName(),
                    'isAdmin'=>$user->isAdmin(),
                    'created'=>$user->getCreated(),
                    'updated'=>$user->getUpdated(),
                ];
            }
            $response->setData([
                'success'=>true,
                'data'=>$data
            ]);
            return $response;
        }
        else{
            $response->setData([
                'success'=>false,
                'data'=>'Algo salio mal'
            ]);
            return $response;
        }
    }
}