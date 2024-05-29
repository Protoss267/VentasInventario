<?php


namespace App\Service\Users;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UpdateUserService
{
    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $encoder){

        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }

    public function __invoke(string $id, string $username, string $password, string $name, bool $isAdmin): User
    {
        $user=$this->userRepository->findUserById($id);

        if ($user != null)
        {
            if($password != '')
            {
                $encodedPassword=$this->encodePassword($this->encoder,$user,$password);
                $user->setPassword($encodedPassword);
            }
            $user->setUsername($username);
            $user->setName($name);
            $user->setIsAdmin($isAdmin);
            $this->userRepository->save($user);
        }else
            throw new \Exception(sprintf('El usuario %s no existe', $user));

        return $user;
    }

    private function encodePassword(UserPasswordEncoderInterface $encoder, $user, $pass)
    {

        return $encoder->encodePassword($user,$pass);
    }

}