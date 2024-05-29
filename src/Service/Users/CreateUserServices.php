<?php


namespace App\Service\Users;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserServices
{

    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserRepository $userRepository,UserPasswordEncoderInterface $encoder)
    {
        $this->userRepository = $userRepository;
        $this->encoder=$encoder;
    }

    public function __invoke(string $user,string $password, string $name, bool $isadmin): User
    {
        $user= new User($name,$user,$isadmin);
        $user->setPassword($this->encodePassword($this->encoder,$user,$password));
        $this->userRepository->save($user);
        return $user;
    }


    private function encodePassword(UserPasswordEncoderInterface $encoder, $user, $pass)
    {

        return $encoder->encodePassword($user,$pass);
    }
}