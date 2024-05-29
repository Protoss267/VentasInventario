<?php


namespace App\Service\Users;


use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUserByUsernameService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository){

        $this->userRepository = $userRepository;
    }

    public function __invoke(string $username){
        $data=[];
        $response = new JsonResponse();
        $user=$this->userRepository->findUserByUsername($username);

        if($user!=null)
        {
            $data[]=[
                'id'=>$user->getId(),
                'name'=>$user->getName(),
                'username'=>$user->getUsername(),
                'isAdmin'=>$user->isAdmin(),
                'initials'=>$this->primerasLetras($user->getName()),
            ];
        }
        else
            $data[]=['Ha Ocurrido un error'];

        $response->setData([
            'success'=>true,
            'data'=>$data
        ]);

        return $response;
    }

    private function primerasLetras(string $name)
    {
        $word[]=explode(' ',$name);
        $initials='';

        if(count($word[0])>1)
        {
            for ($i=0;$i<2;$i++)
            {
                $initials=$initials.substr($word[0][$i],0,1);
                $initials=strtoupper($initials);
            }
        }
        elseif (count($word[0])==1)
        {
            $initials=$initials.substr($word[0][0],0,2);
            $initials=strtoupper($initials);
        }
        return $initials;
    }
}