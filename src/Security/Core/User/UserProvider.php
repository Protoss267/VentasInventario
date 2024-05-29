<?php


namespace App\Security\Core\User;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * @method UserInterface loadUserByIdentifier(string $identifier)
 */class UserProvider implements UserProviderInterface,PasswordUpgraderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername(string $username):UserInterface
    {
        try {
            return $this->userRepository->findOneByUsernameOrFail($username);
        }catch (NotFoundHttpException $exception)
        {
            throw new UsernameNotFoundException(sprintf('Usuario con nombre de usuario: %s no existe',$username));
        }
    }

    public function refreshUser(UserInterface $user)
    {
        if(!$user instanceof User){
            throw new UnsupportedUserException(sprintf('Instancia de %s no encontrada',get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param User $user
     * @param string $newHashedPassword
     */
    public function upgradePassword(UserInterface $user, string $newHashedPassword): void
    {
        $user->setPassword($newHashedPassword);
        $this->userRepository->save($user);
    }

    public function supportsClass(string $class):bool
    {
        return User::class === $class;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method UserInterface loadUserByIdentifier(string $identifier)
    }
}