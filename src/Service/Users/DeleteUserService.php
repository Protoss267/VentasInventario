<?php


namespace App\Service\Users;


use App\Repository\UserRepository;

class DeleteUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $id)
    {
        $user=$this->userRepository->findUserById($id);

        if ($user!=null)
        {
            $this->userRepository->delete($user);

            return ['message'=>'El usuario fue eliminado satisfactoriamente'];
        }
        else
            return ['message'=>'El usuario a eliminar no existe'];
    }
}